<template>
    <div>
        <textarea class="form-control" @input="updateValue($event.target.value)">{{ value }}</textarea>
    </div>
</template>

<script>
    module.exports = {
        props: ['value', 'name'],
        data: function() {
            return {}
        },
        methods: {
            updateValue: function (value) {
                var formattedValue = value.trim();
                if (formattedValue !== value) {
                    this.$refs.input.value = formattedValue
                }
                // Emit the number value through the input event
                this.$emit('input', formattedValue)
            }
        }
    }
</script>

<style scoped>

</style>
