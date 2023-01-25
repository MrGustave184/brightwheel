const checkoutForm = jQuery('form.checkout');
const checkoutModal = new bootstrap.Modal('#checkoutModal');
const skipDiscountBtn = document.getElementById('skip-discount');
const createAccountForm = document.getElementById('create-account-form');
let proceedToPayment = false;

checkoutForm.on('checkout_place_order', function () {
    if (bw.is_user_logged_in) {
        return true;
    }

    checkoutModal.show();
    return proceedToPayment;
});

skipDiscountBtn.addEventListener('click', () => {
    proceedToPayment = true;
    checkoutForm.submit();
});

createAccountForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    const { username, email, password, checkPassword } = document.getElementById("create-account-form").elements;

    if (password.value !== checkPassword.value) {
        const passwordCheckMsg = document.getElementById('passwords-error-msg');
        passwordCheckMsg.classList.remove('d-none');
        passwordCheckMsg.classList.add('show');
        return false;
    }

    // TODO: display errors on response
    await bwPostRequest(`${bw.restUrl}/bw/v1/users`, {
        // quick way for validation/sanitization
        // better add more
        user_login: username.value,
        user_email: email.value,
        user_pass: password.value
    }).then((user) => {
        // need better validation
        if (!user) {
            return false;
        }

        proceedToPayment = true;

        jQuery('input[name=trigger_discount]').val(true);
        jQuery(document.body).trigger('update_checkout');

        checkoutModal.hide();
        checkoutForm.submit();
    });
});

async function bwPostRequest(url, data) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    return response.json();
}