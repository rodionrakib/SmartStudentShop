import AppForm from '../app-components/Form/AppForm';

Vue.component('product-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                sku:  '' ,
                name:  '' ,
                slug:  '' ,
                description:  '' ,
                cover:  '' ,
                quantity:  '' ,
                price:  '' ,
                status:  '' ,
                
            }
        }
    }

});