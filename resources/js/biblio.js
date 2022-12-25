export function validatePhone(phone, phoneInput) {
    if (!phone.isValidNumber() && phone.getNumber()) {
        let message = '';
        switch (phone.getValidationError()) {
            case 1:
                message = 'Code d\'appel du pays non valide';
                break;
            case 2:
                message = 'La chaîne fournie ne semblait pas être un numéro de téléphone valide.';
                break;
            case 3:
                message = 'Numéro de téléphone trop court après un IDD';
                break;
            case 4:
                message = 'La chaîne fournie est trop courte pour être un numéro de téléphone.';
                break;
            case 5:
                message = 'La chaîne fournie est trop longue pour être un numéro de téléphone.';
                break;
            default:
                message = 'Numéro invalide';
                break;
        }
        $(phoneInput).addClass('is-invalid').parents().find('[data-form-error="phone"]').text(message).css('display', 'block')
        return false;
    }
    else {
        $(phoneInput).removeClass('is-invalid').parents().find('[data-form-error="phone"]').text("").css('display', 'none')
        return true;
    }
}
