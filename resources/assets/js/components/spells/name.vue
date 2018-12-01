<template>
    <div>
        <input id="spellName"
               type="text"
               :class="myClass"
               placeholder="Name"
               v-model="myValue"
               @blur="checkName($event.target.value)"
               name="name"
        >
        <small v-if="invalidInput" class="text-danger">Der Name ist bereits vergeben!</small>
    </div>
</template>

<script>
    module.exports = {
        props:    ['spellId', 'value'],
        data:     function() {
            return {
                invalidInput: false,
                myValue:      this.value,
            }
        },
        computed: {
            subId:   function() {
                return 'd-' + this.name;
            },
            myClass: function() {
                return {
                    'form-control':  true,
                    'border-danger': this.invalidInput
                }
            },
        },
        methods:  {
            checkName: function(name) {
                if(!name) {
                    return;
                }
                var spellId = null;
                var that    = this;
                if (typeof this.spellId !== undefined) {
                    spellId = this.spellId;
                }
                $.get('/spells/checkName/' + name + '/' + spellId, function(data) {
                    that.invalidInput = data.result;
                });
            }
        }
    }
</script>

<style scoped>

</style>
