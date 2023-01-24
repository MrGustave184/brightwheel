const checkoutModal = new bootstrap.Modal('#exampleModal');

function showCheckoutModal(event) {
    event.preventDefault();
    checkoutModal.show();
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
                $(document.body).trigger('update_checkout');
                const form = document.forms.checkout;
                form.submit();
            });
    });
});

// createAccountBtn.addEventListener('click', async (event) => {
//     let userCreated = false;

//         event.preventDefault();

    
//     const { username, email, password, checkPassword } = document.getElementById("create-account-form").elements;

//     if (password.value !== checkPassword.value) {
//         const passwordCheckMsg = document.getElementById('passwords-error-msg');
//         passwordCheckMsg.classList.remove('d-none');
//         passwordCheckMsg.classList.add('show');
//         return false;
//     }

//     // TODO: display errors on response
//     await bwPostRequest(`${bw.restUrl}/bw/v1/users`, {
//         // quick way for validation/sanitization
//         // better add more
//         user_login: username.value,
//         user_email: email.value,
//         user_pass: password.value
//     }).then(async (user) => {
//         console.log(user);
//         userCreated = true;
//         checkoutModal.hide();

//         // apply discount coupon
//         // Need better validation of user
//         if (!user) {
//             return false;
//         }

//         await bwPostRequest(`${bw.restUrl}/bw/v1/discount`)
//             .then((discount) => {
//                 console.log(discount)
//                 const form = document.forms.checkout;
//                 form.submit();
//             });
//     });
// });

async function bwPostRequest(url, data) {
    // const url = `${bw.restUrl}/bw/v1/users`;
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    return response.json();
}