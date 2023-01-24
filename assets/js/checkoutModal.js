const checkoutModal = new bootstrap.Modal('#checkoutModal');

/**
 * Better to hook into checkout_place_order but is not behaving as expected and
 * have limited time to debug
 */
// const checkoutForm = jQuery('form.checkout');

// checkoutForm.on('checkout_place_order', function () {
//     checkoutModal.show();
//     return false;
// });

function showCheckoutModal(event, prevent) {
    if (prevent) {
        event.preventDefault();
        checkoutModal.show();
    }
}

const createAccountBtn = document.getElementById('create-account-form');

createAccountBtn.addEventListener('submit', async (event) => {
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
    }).then(async (user) => {
        console.log(user);
        checkoutModal.hide();

        // apply discount coupon
        // Need better validation of user
        if (!user) {
            return false;
        }

        await bwPostRequest(`${bw.restUrl}/bw/v1/discount`)
            .then((discount) => {
                console.log(discount)
                jQuery(document.body).trigger('update_checkout');
                const form = document.forms.checkout;
                let preventDefaultSubmit = false;
                form.submit(event, preventDefaultSubmit);
            });
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