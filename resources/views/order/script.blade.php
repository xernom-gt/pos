{{-- resources/views/order/script.blade.php --}}
@push('script')
<script>
$(function () {
    const orderedList = [];
    const $tbody = $('#tbl-cart tbody');
    const $totalCell = $('#total-cell');
    const $submitBtn = $('#submit-order');
    const $payload = $('#order_payload');
    const $form = $('#order-form');

    const fmtRp = n => 'Rp ' + Number(n).toLocaleString('id-ID');

    function refreshCart() {
        $tbody.empty();
        let total = 0;

        orderedList.forEach(item => {
            const subtotal = item.qty * item.unitPrice;
            total += subtotal;

            const row = `
                <tr data-id="${item.id}">
                    <td>${item.name}</td>
                    <td class="qty">
                        <input type="number" class="form-control form-control-sm qty-input" 
                               value="${item.qty}" min="1" style="width:60px" data-id="${item.id}">
                    </td>
                    <td class="subtotal text-end">${fmtRp(subtotal)}</td>
                    <td>
                        <button class="btn btn-danger btn-sm btn-remove" data-id="${item.id}">X</button>
                    </td>
                </tr>
            `;
            $tbody.append(row);
        });

        $totalCell.text(fmtRp(total));
        $payload.val(JSON.stringify({ items: orderedList, total }));
        $submitBtn.prop('disabled', orderedList.length === 0);
    }

    // Tambah produk
    $(document).on('click', '.btn-add', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const unitPrice = Number($(this).data('price'));

        const existing = orderedList.find(item => item.id === id);
        if (existing) {
            existing.qty += 1;
        } else {
            orderedList.push({ id, name, qty: 1, unitPrice });
        }
        refreshCart();
    });

    // Ubah qty
    $(document).on('change', '.qty-input', function () {
        const id = $(this).data('id');
        const qty = parseInt(this.value);
        if (qty > 0) {
            const item = orderedList.find(i => i.id === id);
            if (item) item.qty = qty;
        } else {
            $(this).closest('tr').remove();
            const index = orderedList.findIndex(i => i.id === id);
            if (index !== -1) orderedList.splice(index, 1);
        }
        refreshCart();
    });

    // Hapus item
    $(document).on('click', '.btn-remove', function () {
        const id = $(this).data('id');
        const index = orderedList.findIndex(i => i.id === id);
        if (index !== -1) orderedList.splice(index, 1);
        refreshCart();
    });

    // === POPUP KONFIRMASI + AJAX SUBMIT ===
    $submitBtn.on('click', function (e) {
        e.preventDefault();

        if (orderedList.length === 0) {
            alert('Keranjang masih kosong!');
            return;
        }

        // Buat modal dinamis
        const modalHtml = `
            <div class="modal fade" id="confirmModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin mengirim pesanan ini?
                            <br><strong>Total: ${fmtRp(orderedList.reduce((s, i) => s + i.qty * i.unitPrice, 0))}</strong>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success" id="confirmYes">Ya, Kirim</button>
                        </div>
                    </div>
                </div>
            </div>`;

        $('#confirmModal').remove();
        $('body').append(modalHtml);

        const modal = new bootstrap.Modal('#confirmModal');
        modal.show();

        // Tombol "Ya, Kirim" → AJAX (Definisi listener ini harus di dalam listener submit)
        $(document).off('click', '#confirmYes').on('click', '#confirmYes', function () {
            // PENTING: Variabel modal sudah dideklarasikan di scope luar
            modal.hide(); 

            const customerId = $('#customer_id').val();
            if (!customerId) {
                alert('Pilih pelanggan terlebih dahulu!');
                // Re-show modal jika diperlukan, atau batalkan proses
                return;
            }

            // Ambil data payload yang sudah ter-update
            const payloadData = $payload.val(); 

            // 1. Tentukan data yang akan dikirim
            const formData = {
                _token: $('input[name="_token"]').val(), // Ambil token CSRF dari form
                customer_id: customerId,
                order_payload: payloadData
            };
            
            // 2. Lakukan Panggilan AJAX
            $.ajax({
                url: "{{ route('order.store') }}", // URL POST order
                method: 'POST',
                data: formData,
                dataType: 'json', // Harapkan respons JSON
                beforeSend: function() {
                    $submitBtn.prop('disabled', true).text('Memproses...');
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        
                        // Kunci form untuk mencegah pengiriman ganda
                        $('#order-form').find('input, select, button').prop('disabled', true); 

                        // Redirect ke URL print yang dikirim dari controller
                        window.location.href = response.print_url; 
                    } else {
                        // Jika success: false (logika di controller)
                        alert('Gagal: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let message = "Terjadi kesalahan saat menyimpan order.";
                    // Cek jika ada response JSON dari Laravel (Validasi atau Error 500)
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                         message = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                         // Tangani error validasi (jika ada)
                         message = "Gagal Validasi! Cek isian form."; 
                    }
                    alert(message);
                },
                complete: function() {
                     $submitBtn.prop('disabled', false).text('Submit Order');
                }
            });
        });
    });
    
    // Inisialisasi: Hapus list lama dan refresh
    orderedList.length = 0;
    refreshCart();
});
</script>
@endpush