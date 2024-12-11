define([
    'jquery',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/view/payment/default',
    'Magento_Checkout/js/action/place-order',
    'Magento_Checkout/js/model/full-screen-loader',
    'Magento_Checkout/js/action/select-payment-method',
    'Magento_Checkout/js/action/set-billing-address',
    'uiRegistry'
], function ($, quote, Component, placeOrderAction, fullScreenLoader, selectPaymentMethodAction, setBillingAddressAction, uiRegistry) {
    'use strict';

    alert('Custom checkout.js initialize is called');
    console.log('Custom checkout.js initialize is called');

    return Component.extend({
        defaults: {
            template: 'WB_OneStepCheckout/payment/checkmo',
        },

        initialize: function () {
            this._super();
            alert('Custom checkout.js initialize is called');
            console.log('Custom checkout.js initialize is called');

            this.setDefaultCountry();
            this.hideFields();
            this.checkSubtotal();
        },

        setDefaultCountry: function () {
            console.log('Setting default country to US');
            var address = quote.billingAddress();
            if (!address.countryId) {
                address.countryId = 'US';
                quote.billingAddress(address);
            }
        },

        hideFields: function () {
            console.log('Hiding unnecessary fields');
            var fieldsToHide = [
                'checkout.steps.billing-step.payment.payments-list.billing-address-form.fieldset.region_id',
                'checkout.steps.billing-step.payment.payments-list.billing-address-form.fieldset.city',
                'checkout.steps.billing-step.payment.payments-list.billing-address-form.fieldset.postcode',
                'checkout.steps.billing-step.payment.payments-list.billing-address-form.fieldset.country_id',
                'checkout.steps.billing-step.payment.payments-list.billing-address-form.fieldset.street.1'
            ];

            fieldsToHide.forEach(function (field) {
                var fieldElement = uiRegistry.get(field);
                if (fieldElement) {
                    console.log('Hiding field:', field);
                    fieldElement.visible(false);
                } else {
                    console.log('Field not found:', field);
                }
            });
        },

        checkSubtotal: function () {
            console.log('Checking subtotal');
            var subtotal = quote.getTotals()().subtotal;
            if (subtotal >= 100 && subtotal < 300) {
                var remaining = 300 - subtotal;
                console.log('Subtotal is between 100 and 300. Remaining amount:', remaining);
                $('.message.notice').text('Add more items worth $' + remaining + ' and get free shipping over $300.');
            }
        },

        afterPlaceOrder: function () {
            console.log('Placing order');
            $.ajax({
                url: '/onestepcheckout/ajax/placeorder',
                type: 'POST',
                data: { orderId: this.orderId },
                success: function (response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirectUrl;
                    }
                }
            });
        }
    });
});
