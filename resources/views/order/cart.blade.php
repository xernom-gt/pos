<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Keranjang</h5>
    </div>
    <div class="card-body p-0">
       <div class="mb-3 p-3 border-bottom">
            <label for="customer_id" class="form-label">Pelanggan</label>
            <select name="customer_id" id="customer_id" class="form-select form-select-sm" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <table class="table table-sm table-borderless mb-0" id="tbl-cart">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th width="70">Qty</th>
                    <th width="100">Subtotal</th>
                    <th width="40">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <td colspan="2" class="text-end fw-bold">Total</td>
                    <td id="total-cell" class="fw-bold">Rp0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
        <input type="hidden" name="order_payload" id="order_payload">
        <button type="submit" id="submit-order" class="btn btn-success w-100" disabled>
            Submit Order
        </button>
    </div>
</div>