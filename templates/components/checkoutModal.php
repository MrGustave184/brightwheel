<!-- TODO: Add internationalization - remove from here or include wp-load -->
<div class="modal fade p-5" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register before checkout to get 10% discount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="passwords-error-msg" class="alert alert-danger alert-dismissible fade d-none" role="alert">
                    Passwords do not match!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form id="create-account-form">
                    <div class="mb-3">
                        <label for="bw-username" class="form-label">Username</label>*
                        <input type="text" name="username" class="form-control" id="bw-username" required>
                    </div>
                    <div class="mb-3">
                        <label for="bw-email" class="form-label">Email</label>*
                        <input type="email" name="email" class="form-control" id="bw-email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="bw-password" class="form-label">Password</label>*
                        <input type="password" name="password" class="form-control" id="bw-password" required>
                    </div>
                    <div class="mb-3">
                        <label for="bw-checkPassword" class="form-label">Password Again</label>*
                        <input type="password" name="checkPassword" class="form-control" id="bw-checkPassword" required>
                    </div>
                    <div class="mb-3 form-check d-flex d-flex justify-content-center align-items-center">
                        <input type="checkbox" name="terms" class="form-check-input" id="bw-check-terms" required>
                        <label class="form-check-label" for="bw-check-terms">Agree to terms and conditions</label>*
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <button id="create-account-btn" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="skip-discount" class="btn btn-primary">Skip and proccess payment</button>
            </div>
        </div>
    </div>
</div>