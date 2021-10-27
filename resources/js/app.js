require('./bootstrap');

const btnUserProfileEdit = document.querySelector('.btn--edition');
const UserProfileFormEdit = document.querySelector('.user-profile__form-edit');

if(btnUserProfileEdit) {
    btnUserProfileEdit.addEventListener('click', function () {
        UserProfileFormEdit.classList.remove('hide');
    });
}
