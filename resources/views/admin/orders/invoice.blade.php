<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Facture #{{ $order->order_number ?? $order->id }} - {{ config('app.name') }}</title>
    <style>
        @page { margin: 20mm; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; line-height: 1.5; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { font-size: 24px; margin: 0; }
        .header p { color: #666; margin: 4px 0 0; }
        .info { margin-bottom: 24px; }
        .info table { width: 100%; }
        .info td { vertical-align: top; width: 50%; }
        .info h3 { font-size: 14px; margin: 0 0 6px; }
        .info p { margin: 2px 0; color: #555; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        table.items th { background: #f5f5f5; text-align: left; padding: 8px 10px; font-size: 12px; }
        table.items td { padding: 8px 10px; border-bottom: 1px solid #eee; }
        table.items .right { text-align: right; }
        table.items .center { text-align: center; }
        .total { text-align: right; font-size: 14px; font-weight: bold; margin-top: 8px; }
        .footer { text-align: center; color: #999; font-size: 11px; margin-top: 40px; border-top: 1px solid #eee; padding-top: 12px; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-size: 11px; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger { background: #f8d7da; color: #721c24; }
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
        .no-print { text-align: center; margin-bottom: 20px; }
        .no-print button { padding: 10px 24px; font-size: 14px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">Imprimer</button>
    </div>

    <div class="header">
        <h1>{{ config('app.name', 'EduMarket') }}</h1>
        <p>Facture</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>
                    <h3>Facturé à</h3>
                    <p><strong>{{ $order->full_name ?? $order->user?->name }}</strong></p>
                    <p>{{ $order->shipping_address }}</p>
                    @if ($order->city)<p>{{ $order->city }}</p>@endif
                    <p>{{ $order->phone ?? '' }}</p>
                    <p>{{ $order->user?->email }}</p>
                </td>
                <td>
                    <h3>Détails</h3>
                    <p><strong>N° commande :</strong> #{{ $order->order_number ?? $order->id }}</p>
                    <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Statut :</strong>
                        @php
                            $badge = match ($order->status) {
                                'pending' => 'badge-warning',
                                'processing' => 'badge-info',
                                'completed' => 'badge-success',
                                'cancelled' => 'badge-danger',
                                default => '',
                            };
                            $label = match ($order->status) {
                                'pending' => 'En attente',
                                'processing' => 'En cours',
                                'completed' => 'Terminée',
                                'cancelled' => 'Annulée',
                                default => $order->status,
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ $label }}</span>
                    </p>
                    <p><strong>Paiement :</strong>
                        @php
                            $pmLabel = match ($order->payment_method) {
                                'cash_on_delivery' => 'À la livraison',
                                'credit_card' => 'Carte bancaire',
                                'paypal' => 'PayPal',
                                'bank_transfer' => 'Virement',
                                default => $order->payment_method,
                            };
                        @endphp
                        {{ $pmLabel }}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Produit</th>
                <th class="center">Quantité</th>
                <th class="right">Prix unitaire</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product?->title ?? 'Produit supprimé' }}</td>
                    <td class="center">{{ $item->quantity }}</td>
                    <td class="right">{{ number_format($item->price, 2) }} €</td>
                    <td class="right">{{ number_format($item->subtotal, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total : {{ number_format($order->total, 2) }} €
    </div>

    @if ($order->notes)
        <div style="margin-top: 20px;">
            <strong>Notes :</strong>
            <p>{{ $order->notes }}</p>
        </div>
    @endif

    <div class="footer">
        <p>{{ config('app.name', 'EduMarket') }} &mdash; Merci de votre confiance.</p>
    </div>
</body>
</html>
