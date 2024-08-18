<div class="container-fluid mt-4" id="invoiceContainer">
    <h2>Create New INVOICE</h2>
    <form action="save_invoice.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="invoiceDate">Invoice Date</label>
                    <input type="date" class="form-control" id="invoiceDate" name="invoice_date" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dueDate">Due Date</label>
                    <input type="date" class="form-control" id="dueDate" name="due_date" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="invoiceType">Select Type:</label>
                    <select class="form-control" id="invoiceType" name="invoice_type">
                        <option>Invoice</option>
                        <option>Estimate</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="invoiceStatus">Status:</label>
                    <select class="form-control" id="invoiceStatus" name="invoice_status">
                        <option>Open</option>
                        <option>Paid</option>
                        <option>Overdue</option>
                    </select>
                </div>
            </div>
        </div>

        <h4 class="mt-4">Customer Information</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name="customer_name" required>
                </div>
                <div class="form-group">
                    <label for="address1">Address 1</label>
                    <input type="text" class="form-control" id="address1" name="address_1" required>
                </div>
                <div class="form-group">
                    <label for="town">Town</label>
                    <input type="text" class="form-control" id="town" name="town" required>
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address2">Address 2</label>
                    <input type="text" class="form-control" id="address2" name="address_2">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone_number" required>
                </div>
            </div>
        </div>

        <h4 class="mt-4">Product Information</h4>
        <div id="productList">
            <div class="row product-item">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="productName">Product Name or Description</label>
                        <input type="text" class="form-control" id="productName" name="product_name[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="quantity[]" value="1" min="1" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price[]" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="discount">Discount</label>
                        <input type="text" class="form-control" id="discount" name="discount[]">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success mb-3" id="addProduct"><i class="fas fa-plus"></i> Add Product</button>

        <div class="form-group">
            <label for="additionalNotes">Additional Notes:</label>
            <textarea class="form-control" id="additionalNotes" name="additional_notes" rows="3"></textarea>
        </div>

        <h4 class="mt-4">Invoice Summary</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subTotal">Sub Total:</label>
                    <input type="text" class="form-control" id="subTotal" name="sub_total" readonly>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tax">Tax:</label>
                    <input type="text" class="form-control" id="tax" name="tax">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="totalAmount">Total Amount:</label>
                    <input type="text" class="form-control" id="totalAmount" name="total_amount" readonly>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Invoice</button>
    </form>
</div>
