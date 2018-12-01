<template>
    <div class="form-check">
        <label class="form-check-label">
            <input @change="updateValue($event.target.checked)"
                   type="checkbox"
                   v-model="checked"
                   class="form-check-input"><strong><u>{{ addSign(attribute) }}</u></strong> {{ description }}
        </label>
    </div>
</template>

<script>
    module.exports = {
        props:    ['value', 'attribute', 'description', 'checked'],
        data:     function() {
            return {}
        },
        computed: {
            id: function() {
                return 'd-' + this.name;
            }
        },
        methods:  {
            updateValue: function(value) {
                this.$emit('input', value)
            },
            addSign:     function(num) {
                num = parseInt(num);
                if (isNaN(num)) {
                    num = 0;
                }
                if (num > 0) {
                    return '+' + num;
                } else {
                    return num;
                }
            },
        }
    }
</script>

<style scoped>

</style>
