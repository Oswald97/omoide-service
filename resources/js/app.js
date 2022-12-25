require('./bootstrap');
require('country-select-js');
$ = require('jquery');
intlTelInput = require('intl-tel-input');
intlTelUtiles = require('intl-tel-input/build/js/utils');
biblio = require('./biblio');
FileUploadWithPreview = require("file-upload-with-preview");


let validateInputs = [ 'name', 'surname', 'username', 'formFile[]', 'address', 'country', 'name', 'phone'];

validateInputs.forEach((el) => {
    let element = $('.billing-form').find(`[name="${el}"]`);
    element.on('change',  () => {
        if (!element.val() &&  el !== 'phone') {
            element.addClass('is-invalid').parents().find(`[data-form-error="${el}"]`).css('display', 'block');
        }
        else {
            element.removeClass('is-invalid').parents().find(`[data-form-error="${el}"]`).css('display', 'none');
        }
    })
});

$('button[type="submit"]').on('click', (e) => {
    e.preventDefault();
    let isValid = true;
    validateInputs.forEach((el) => {
        let element = $('.billing-form').find(`[name="${el}"]`);
        if (!element.val()) {
            if (el === 'phone') {
                $(phoneInput).addClass('is-invalid').parents().find(`[data-form-error="${el}"]`).text("Veuillez entrer votre numéro de téléphone").css('display', 'block')
            }
            else {
                element.addClass('is-invalid').parents().find(`[data-form-error="${el}"]`).css('display', 'block');
            }
            isValid = false;
        }
        else {
            element.removeClass('is-invalid').parents().find(`[data-form-error="${el}"]`).css('display', 'none');
        }
    });
    if (isValid) {
        $('.billing-form').submit();
        $('.full-page-loader').css('display', 'block');
    }
});

const phoneInput = document.querySelector("#phone");
const countryInput = $("#country");
let phone = intlTelInput(phoneInput, {
    initialCountry: 'bj',
    onlyCountries: ['bj', 'sn', 'ci', 'ga'],
    separateDialCode: true,
    utilsScript: intlTelUtiles
});

countryInput.countrySelect({
    defaultCountry: "bj",
    onlyCountries: ['bj', 'sn', 'ci', 'ga'],
    responsiveDropdown: true
});

$(phoneInput).parent().parent().find('input[name="dialCode"]').val(phone.getSelectedCountryData().dialCode);

countryInput.on('change', () => {
    const selectedCountry = countryInput.countrySelect("getSelectedCountryData");
    phone.setCountry(selectedCountry.iso2);
});

phoneInput.addEventListener("countrychange", function() {
    const selectedTel = phone.getSelectedCountryData();
    countryInput.countrySelect("selectCountry", selectedTel.iso2);
    $(phoneInput).parent().parent().find('input[name="dialCode"]').val(selectedTel.dialCode);
    biblio.validatePhone(phone, phoneInput);
});

$(phoneInput).on('blur', () => {
    biblio.validatePhone(phone, phoneInput);
});

new FileUploadWithPreview.default("myUniqueUploadId", {
    text: {
        chooseFile: "Choisissez vos photos",
        browse: "Sélectionner",
        selectedCount: "Fichier(s) sélectionné(s)",
    }
});

window.addEventListener("fileUploadWithPreview:imagesAdded", function (e) {
    if (e.detail.addedFilesCount > 0) {
        $('.custom-file-container__image-preview').css('display', 'block')
    }
});

window.addEventListener("fileUploadWithPreview:imageDeleted", function (e) {
    if (e.detail.currentFileCount === 0) {
        $('.custom-file-container__image-preview').css('display', 'none')
    }
});

window.addEventListener("fileUploadWithPreview:clearButtonClicked", function (e) {
    $('.custom-file-container__image-preview').css('display', 'none')
});


