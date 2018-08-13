<template>
    <div v-if="spell != null" class="card">
        <div class="card-header bg-primary text-dark"><b>{{ spell.name }}<br>
            <small>{{ schoolAndGrade }}</small>
        </b>
        </div>
        <div class="card-body">
            Zeitaufwand: <i>{{ spell.cast_duration }}</i><br>
            Reichweite: <i>{{ spell.range }}</i><br>
            Komponenten: <i>{{ components }}</i><br>
            Dauer: <i>{{ spell.duration }}</i><br>
            <br>
            <span style="white-space:pre-wrap; word-wrap:break-word;" v-html="infos"></span>
        </div>
    </div>
</template>

<script>
    module.exports = {
        props:    ['spell', 'schools'],
        data:     function() {
            return {}
        },
        computed: {
            infos:          function() {
                let desc = this.spell.description;
                let exp  = RegExp(/\*\*(.*)\*\*/, 'g');
                return desc.replace(exp, '<b>$1</b>');
            },
            schoolAndGrade: function() {
                if (this.spell.rank) {
                    switch (parseInt(this.spell.school_id)) {
                        case 1:
                            return 'Bann des ' + this.spell.rank + '. Grades';
                        case 2:
                            return 'Beschwörung des ' + this.spell.rank + '. Grades';
                        case 3:
                            return 'Erkenntnismagie des ' + this.spell.rank + '. Grades';
                        case 4:
                            return 'Verzauberung des ' + this.spell.rank + '. Grades';
                        case 5:
                            return 'Hervorrufung des ' + this.spell.rank + '. Grades';
                        case 6:
                            return 'Illusion des ' + this.spell.rank + '. Grades';
                        case 7:
                            return 'Nekromantie des ' + this.spell.rank + '. Grades';
                        case 8:
                            return 'Verwandlung des ' + this.spell.rank + '. Grades';
                        default:
                            return 'Spruch des ' + this.spell.rank + '. Grades';
                    }
                } else {
                    switch (parseInt(this.spell.school_id)) {
                        case 1:
                            return 'Zaubertrick der Bannmagie';
                        case 2:
                            return 'Zaubertrick der Beschwörungsmagie';
                        case 3:
                            return 'Zaubertrick der Erkenntnismagie';
                        case 4:
                            return 'Zaubertrick der Verzauberung';
                        case 5:
                            return 'Zaubertrick der Hervorrufungsmagie';
                        case 6:
                            return 'Zaubertrick der Illusionsmagie';
                        case 7:
                            return 'Zaubertrick der Nekromantie';
                        case 8:
                            return 'Zaubertrick der Verwandlungsmagie';
                        default:
                            return 'Zaubertrick';
                    }
                }
            },

            components: function() {
                let comps = [];
                let res   = '';
                if (this.spell.component_voice) {
                    comps.push('V');
                }
                if (this.spell.component_gesture) {
                    comps.push('G');
                }
                if (this.spell.component_material) {
                    comps.push('M');
                }
                res = comps.join(', ');
                if (this.spell.material) {
                    res += ' (' + this.spell.material + ')';
                }
                return res;
            }
        }
    }
</script>

<style scoped>

</style>
