$.validator.addMethod("email", function(value, element, param) {
    if (value.length === 0 && !element.required) {
        return true;
    }

    return value.length > 0 && /^[\w+.-]+@[\w+.-]+\.\w+$/.test(value);
}, "Please enter a valid email address");

$.validator.addMethod("notEqual", function(value, element, param) {
    return this.optional(element) || value != $(param).val();
}, "Please enter not equal value");

$.validator.addMethod("phone", function(value, element, param) {
    return !value || value.length >= 18;
}, "Please enter a valid phone");

$.validator.addMethod("max", function(value, element, param) {
    return value.trim().length < 50;
}, "");

$.validator.addClassRules({phone : { phone : true }  });