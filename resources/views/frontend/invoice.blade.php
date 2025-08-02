@extends('frontend.layouts.main')
@section('content')

    <div class="x_invoice-container"
        style="max-width: 700px; margin: 40px auto; background: #181818; border-radius: 12px; box-shadow: 0 0 24px #000a; padding: 40px 32px;">
        <div class="x_invoice-header"
            style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ad9d79; padding-bottom: 18px; margin-bottom: 32px;">
            <div>
                <h1 style="margin: 0; color: #ad9d79; font-size: 2.2rem;">INVOICE</h1>
                <div style="color: #cfcfcf; font-size: 1.1rem; margin-top: 6px;">{{ $payment->id }}</div>
                <div style="color: #8f99a3; font-size: 0.98rem;">Date: {{ \Carbon\Carbon::parse($payment->created_at)->format('Y-m-d') }}</div>
            </div>
            <div style="text-align: right;">
                <div style="font-size: 1.2rem; color: #fffbe6; font-weight: 600;">YOYO</div>
                <div style="color: #cfcfcf; font-size: 1rem;">info@yoyokhel.com</div>
                <div style="color: #cfcfcf; font-size: 1rem;">1800 9797 6361</div>
            </div>
        </div>
        <div class="x_invoice-address" style="display: flex; justify-content: space-between; margin-bottom: 32px;">
            <div>
                <div style="color: #ad9d79; font-weight: 500; margin-bottom: 4px;">Billed To:</div>
                <div style="color: #fff; font-size: 1.05rem;">{{ $payment->user->name }}</div>
                <div style="color: #cfcfcf; font-size: 0.98rem;">{{ $payment->user->email }}</div>
                <div style="color: #cfcfcf; font-size: 0.98rem;">{{ $payment->user->phone ?? 'Address not available' }}</div>
            </div>
            <div>
                <div style="color: #ad9d79; font-weight: 500; margin-bottom: 4px;">Payment Method:</div>
                <div style="color: #fff; font-size: 1.05rem;">{{ $payment->payment_type ?? 'N/A' }}</div>
            </div>
        </div>
        @php $subtotal = 0; @endphp
            <table class="x_invoice-table" style="width: 100%; border-collapse: collapse; margin-bottom: 32px;">
                <thead>
                        <tr style="background: #222; color: #ad9d79;">
                            <th style="padding: 12px 8px; text-align: left;">Item</th>
                            <th style="padding: 12px 8px; text-align: right;">Qty</th>
                            <th style="padding: 12px 8px; text-align: right;">Unit Price</th>
                        </tr>
                </thead>
                <tbody>
                        @foreach($cartItems as $item)
                            @php
                                $unitPrice = $item->price > 0 ? $item->price : ($item->product->price ?? 0);
            $total = $item->quantity * $unitPrice;
            $subtotal += $total;
                            @endphp
                        
                            <tr style="border-bottom: 1px solid #444;">
                                <td style="padding: 10px 8px; color: #fff;">
                                    {{ $item->product->name ?? 'Unknown Product' }}
                                </td>
                                <td style="padding: 10px 8px; text-align: right; color: #cfcfcf;">
                                  {{ $item->quantity }}
                                </td>
                                <td style="padding: 10px 8px; text-align: right; color: #cfcfcf;">
                                    ${{ number_format($item->product->price, 2) }}
                                </td>
                                
                            </tr>
                        @endforeach
                </tbody>
            @php
                $gst = $subtotal * 0.18;
                $grandTotal = $subtotal + $gst;
            @endphp
                    <tfoot>
                <tr>
                    <td colspan="2" style="padding: 10px 8px; text-align: right; color: #ad9d79; font-weight: 600;">
                        Subtotal
                    </td>
                    <td style="padding: 10px 8px; text-align: right; color: #fff; font-weight: 600;">
                         ${{ number_format($subtotal, 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px 8px; text-align: right; color: #ad9d79;">
                        GST (18%)
                    </td>
                    <td style="padding: 10px 8px; text-align: right; color: #fff;">
                        ${{ number_format($gst, 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px 8px; text-align: right; color: #ad9d79; font-size: 1.1rem;">
                        Total
                    </td>
                    <td style="padding: 10px 8px; text-align: right; color: #fff; font-size: 1.1rem; font-weight: 700;">
                        ${{ number_format($grandTotal, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="x_invoice-footer" style="text-align: center; color: #8f99a3; font-size: 1rem; margin-top: 32px;">
            Thank you for your purchase!<br>
            <span style="color: #ad9d79;">Yoyo Khel</span> | www.yoyokhel.com
        </div>
    </div>
    <div class="text-center my-4">
        <button class="db_view_all_btn me-2" id="downloadInvoiceBtn"><i class="fa fa-download me-1"></i>Download</button>
        <button class="db_view_all_btn" onclick="window.history.back()"><i class="fa fa-times me-1"></i>Cancel</button>
    </div>

  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jsPDF and html2canvas CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        document.getElementById('downloadInvoiceBtn').addEventListener('click', function () {
            const invoice = document.querySelector('.x_invoice-container');
            html2canvas(invoice, { scale: 2, useCORS: true }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new window.jspdf.jsPDF({ orientation: 'p', unit: 'pt', format: 'a4' });
                // Calculate width/height for A4
                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const imgWidth = pageWidth - 40; // 20pt margin each side
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let y = 20;
                if (imgHeight > pageHeight - 40) {
                    // Multi-page
                    let position = 20;
                    let remainingHeight = imgHeight;
                    while (remainingHeight > 0) {
                        pdf.addImage(imgData, 'PNG', 20, position, imgWidth, imgHeight);
                        remainingHeight -= (pageHeight - 40);
                        if (remainingHeight > 0) {
                            pdf.addPage();
                            position = 0;
                        }
                    }
                } else {
                    pdf.addImage(imgData, 'PNG', 20, y, imgWidth, imgHeight);
                }
                pdf.save('invoice.pdf');
            });
        });
    </script>
@endsection