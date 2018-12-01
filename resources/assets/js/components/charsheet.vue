<template>
    <div class="card char">
        <div class="card-body">
            <div class="form-row">
                <div class="col-3">
                    <div>{{ user.name }}</div>
                    <small class="form-text text-muted">Spieler</small>
                </div>
                <div class="col-2">
                    <form-select :options="classes" v-model="c.char_class_id" description="Klasse" name="class"></form-select>
                </div>
                <div class="col-1">
                    <form-select :options="levels"
                              v-model="c.level"
                              @input="updateLevel($event)"
                              description="Stufe"
                              name="level"></form-select>
                </div>
                <div class="col-3">
                    <form-input v-model="c.background" description="Hintergrund" name="background"></form-input>
                </div>
                <div class="col-3">
                    <form-input v-model="c.deity" description="Gottheit" name="deity"></form-input>
                </div>
            </div>
            <div class="form-row">
                <div class="col-3">
                    <form-input v-model="c.name" description="Charaktername" name="name"></form-input>
                </div>
                <div class="col-3">
                    <form-select :options="races" v-model="c.race_id" description="Rasse" name="race"></form-select>
                </div>
                <div class="col-3">
                    <form-select :options="alignments"
                              v-model="c.alignment_id"
                              description="Gesinnung"
                              name="alignment"></form-select>
                </div>
                <div class="col-3">
                    <form-input v-model="c.experience" description="Erfahrung" name="experience"></form-input>
                </div>
            </div>
            <ul class="nav nav-tabs" id="char-tabs" role="tablist">
                <li class="nav-item">
                    <a :class="switchTabHeader(1)"
                       @click="setTab(1)"
                       href="#t0"
                    >Werte</a>
                </li>
                <li class="nav-item">
                    <a :class="switchTabHeader(2)"
                       href="#t1"
                       @click="setTab(2)">Person</a>
                </li>
                <li class="nav-item">
                    <a :class="switchTabHeader(3)"
                       href="#t2"
                       @click="setTab(3)">Merkmale & Inventar</a>
                </li>
                <li class="nav-item">
                    <a :class="switchTabHeader(4)"
                       href="#t3"
                       @click="setTab(4)">Magie</a>
                </li>
                <li v-if="classSpells.length" class="nav-item">
                    <a :class="switchTabHeader(5)"
                       href="#t4"
                       @click="setTab(5)">Spruchbuch</a>
                </li>
            </ul>
            <div class="tab-content" id="char-tab-content">
                <div class="card bg-light">
                    <div class="card-body">
                        <div class="" :style="switchTab(1)">
                            <div class="d-flex justify-content-between">
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div><strong><u>{{ addSign(bonus.dexterity) }}</u></strong> Initiative</div>
                                    <div><strong><u>{{ addSign(c.proficiency_bonus) }}</u></strong> Übungsbonus</div>
                                    <div><strong><u>{{ addSign(skillBonus.perception + 10) }}</u></strong>
                                        Passive Wahrnehmung
                                    </div>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <form-input v-model="c.armor_class"
                                             description="Rüstungsklasse"
                                             name="armor-class"></form-input>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <form-input v-model="c.movement"
                                             description="Bewegungsrate (m)"
                                             name="movement"></form-input>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                type="checkbox"
                                                class="" v-model="dsSuccess1" @change="setDeathSave()">
                                            <input
                                                type="checkbox"
                                                class="" v-model="dsSuccess2" @change="setDeathSave()">
                                            <input
                                                type="checkbox"
                                                class="" v-model="dsSuccess3" @change="setDeathSave()"> Erfolg
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                type="checkbox"
                                                class="" v-model="dsFail1" @change="setDeathSave()">
                                            <input
                                                type="checkbox"
                                                class="" v-model="dsFail2" @change="setDeathSave()">
                                            <input
                                                type="checkbox"
                                                class="" v-model="dsFail3" @change="setDeathSave()"> Fehlschlag
                                        </label>
                                    </div>
                                    <div class="small form-text text-muted">Rettungswürfe gegen Tod</div>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div class="input-group" style="width:150px;">
                                        <input class="form-control" v-model="c.max_hp">
                                        <input class="form-control" v-model="c.current_hp">
                                        <input class="form-control" v-model="c.temporary_hp">
                                    </div>
                                    <small class="form-text text-muted">HP Max/Jetzt/Temp</small>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div class="input-group" style="width:150px;">
                                        <input class="form-control" v-model="c.hit_die">
                                        <input class="form-control" v-model="c.current_hit_die">
                                    </div>
                                    <small class="form-text text-muted">Trefferwürfel Max/Jetzt</small>
                                </div>
                                <div class="bg-white p-2 rounded border">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                type="checkbox"
                                                class="form-check-input" v-model="c.inspiration"> Inspiration
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <table class="table table-light table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th v-for="attribute in attributes" :key="attribute">
                                        {{ attributeLabels[attribute] }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Wert</td>
                                    <td v-for="attribute in attributes" :key="attribute">
                                        <input @keyup="recalculate()"
                                               type="text"
                                               class="form-control"
                                               v-model="c[attribute]">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bonus</td>
                                    <td v-for="attribute in attributes" :key="attribute">
                                        {{ bonus[attribute] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rettungswurf</td>
                                    <td v-for="attribute in attributes" :key="attribute">
                                        <form-checkbox @input="updateSave(attribute, $event)"
                                                    :attribute="saves[attribute]"
                                                    description=""></form-checkbox>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fertigkeiten</td>
                                    <td v-for="attribute in attributes" :key="attribute">

                                        <form-checkbox v-for="skill in skills[attribute]"
                                                    :key="skill"
                                                    @input="updateSkill(skill, $event)"
                                                    :attribute="skillBonus[skill]"
                                                    :description="skillLabels[skill]"></form-checkbox>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="" :style="switchTab(2)">
                            <div class="form-row d-form m-1 bg-white rounded border pt-2">
                                <div class="col-2">
                                    <form-input v-model="c.age" description="Alter" name="age"></form-input>
                                </div>
                                <div class="col-2">
                                    <form-input v-model="c.height" description="Größe" name="height"></form-input>
                                </div>
                                <div class="col-2">
                                    <form-input v-model="c.weight" description="Gewicht" name="weight"></form-input>
                                </div>
                                <div class="col-2">
                                    <form-input v-model="c.eye_color" description="Augenfarbe" name="eye-color"></form-input>
                                </div>
                                <div class="col-2">
                                    <form-input v-model="c.skin_color" description="Hautfarbe" name="skin-color"></form-input>
                                </div>
                                <div class="col-2">
                                    <form-input v-model="c.hair_color" description="Haarfarbe" name="hair-color"></form-input>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header bg-white">Persönlichkeit</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;width:100%"
                                                      v-model="c.personality"></form-textarea></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header bg-white">Ideale</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;width:100%"
                                                      v-model="c.ideal"></form-textarea></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header bg-white">Bindungen</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;width:100%"
                                                      v-model="c.connection"></form-textarea></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header bg-white">Makel</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;width:100%"
                                                      v-model="c.weakness"></form-textarea></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header bg-white">Aussehen</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;width:100%"
                                                      v-model="c.appearance"></form-textarea></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header bg-white">Verbündete & Organisationen</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;width:100%"
                                                      v-model="c.allies"></form-textarea></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-header bg-white">Berufe und Sprachen</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;" v-model="c.languages"></form-textarea></div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="card">
                                        <div class="card-header bg-white">Hintergrundgeschichte</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="height:200px;" v-model="c.background_story"></form-textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="" :style="switchTab(3)">
                            <div class="d-flex justify-content-between">
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div><strong><u>{{ addSign(bonus.dexterity) }}</u></strong> Initiative</div>
                                    <div><strong><u>{{ addSign(c.proficiency_bonus) }}</u></strong> Übungsbonus</div>
                                    <div><strong><u>{{ addSign(skillBonus.perception + 10) }}</u></strong>
                                        Passive Wahrnehmung
                                    </div>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <form-input v-model="c.armor_class"
                                             description="Rüstungsklasse"
                                             name="armor-class2"></form-input>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div class="input-group" style="width:150px;">
                                        <input class="form-control" v-model="c.max_hp">
                                        <input class="form-control" v-model="c.current_hp">
                                        <input class="form-control" v-model="c.temporary_hp">
                                    </div>
                                    <small class="form-text text-muted">HP Max/Jetzt/Temp</small>
                                </div>
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div class="input-group" style="width:400px;">
                                        <input class="form-control" v-model="c.copper">
                                        <input class="form-control" v-model="c.silver">
                                        <input class="form-control" v-model="c.gold">
                                        <input class="form-control" v-model="c.platinum">
                                    </div>
                                    <small class="form-text text-muted">Münzen Kupfer/Silber/Gold/Platin</small>
                                </div>

                            </div>
                            <hr>
                            <div class="d-flex flex-row">
                                <div class="d-flex flex-column col-8">
                                    <div class="card">
                                        <div class="card-header bg-white">Angriffe und Zauberwirken</div>
                                        <div class="card-body">
                                            <table class="table table-light table-bordered table-responsive-sm">
                                                <thead>
                                                <tr>
                                                    <th>Ü</th>
                                                    <th>Name</th>
                                                    <th>Bonus</th>
                                                    <th>Schaden/Art</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="attack in c.attacks">
                                                    <td>
                                                        <input type="checkbox"
                                                               @input="recalculate()"
                                                               v-model="attack.proficient">
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               @keyup="recalculate()"
                                                               v-model="attack.name">
                                                    </td>
                                                    <td>
                                                        <select v-model="attack.bonus" @change="recalculate()">
                                                            <option value="">--</option>
                                                            <option value="strength">ST</option>
                                                            <option value="dexterity">GE</option>
                                                            <option value="constitution">KO</option>
                                                            <option value="intelligence">IN</option>
                                                            <option value="wisdom">WE</option>
                                                            <option value="charisma">CH</option>
                                                        </select>
                                                        {{ attackBonus(attack.bonus, attack.proficient) }}
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               @keyup="recalculate()"
                                                               v-model="attack.damage">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card mt-2">
                                        <div class="card-header bg-white">Inventar</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="min-height:600px"
                                                      v-model="c.inventory"></form-textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-header bg-white">Merkmale</div>
                                        <div class="card-body">
                                            <form-textarea class="rounded form-control"
                                                      style="min-height:800px;" v-model="c.feats"></form-textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" :style="switchTab(4)">
                            <spell :spell="currentSpell" :schools="schools"></spell>
                            <div class="d-flex justify-content-between">
                                <div class="bg-white p-2 mr-2 rounded border">
                                    <div><strong><u>{{ casterAttribute }}</u></strong> Zauberattribut</div>
                                    <div><strong><u>{{ addSign(spellDifficulty) }}</u></strong>
                                        Rettungswurf-Schwierigkeitsgrad
                                    </div>
                                    <div><strong><u>{{ addSign(spellBonus) }}</u></strong> Zauberangriffsbonus</div>
                                </div>
                            </div>
                            <div v-if="c.spells" class="d-flex flex-row flex-wrap">
                                <div class="card m-1" style="width: 400px;">
                                    <div class="card-header bg-white">Zaubertricks</div>
                                    <div class="card-body"><form-textarea style="width:100%; height: 400px;"
                                                                     v-model="c.spells[0].text"></form-textarea></div>
                                </div>

                                <div v-for="(spell,i) in c.spells"
                                     :key="i"
                                     v-if="i > 0"
                                     class="card m-1"
                                     style="width: 400px;">
                                    <div class="card-header bg-white">Grad {{ i }}: <input type="text"
                                                                                           class="form-control form-inline"
                                                                                           style="width:50px; display:inline-block"
                                                                                           v-model="c.spells[i].slots">
                                        Slots
                                    </div>
                                    <div class="card-body"><form-textarea style="width:100%; height: 400px;"
                                                                     v-model="c.spells[i].text"></form-textarea></div>

                                </div>
                            </div>
                        </div>
                        <div v-if="c.spells" class="" :style="switchTab(5)">
                            <spell :spell="currentSpell" :schools="schools"></spell>
                            <div class="d-flex flex-row flex-wrap">
                                <div v-for="(spells, rank) in classSpells" class="card m-1" style="width:400px;">
                                    <div v-if="rank" class="card-header bg-white font-weight-bold">{{ rank }}. Grad</div>
                                    <div v-else class="card-header bg-white">Zaubertricks</div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"
                                            v-for="(spell, i) in spells"
                                            :key="i"
                                            @click="displaySpell(spell)">
                                            {{ spell.name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    module.exports = {
        props: ['c', 'races', 'classes', 'alignments', 'user', 'schools', 'spells'],

        data: function() {
            return {
                activeTab:       1,
                bonus:           {
                    strength:     0,
                    dexterity:    0,
                    constitution: 0,
                    intelligence: 0,
                    wisdom:       0,
                    charisma:     0,
                },
                skillBonus:      {},
                attributes:      ['strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma'],
                skills:          {
                    strength:     ['athletics'],
                    dexterity:    ['acrobatics', 'sleigh_of_hands', 'stealth'],
                    constitution: [],
                    intelligence: ['arcane', 'history', 'investigation', 'nature', 'religion'],
                    wisdom:       ['medicine', 'animal_handling', 'insight', 'survival', 'perception'],
                    charisma:     ['performance', 'intimidation', 'deception', 'persuasion']
                },
                attributeLabels: {
                    strength:     'Stärke',
                    dexterity:    'Geschicklichkeit',
                    constitution: 'Konstitution',
                    intelligence: 'Intelligenz',
                    wisdom:       'Weisheit',
                    charisma:     'Charisma'
                },
                skillLabels:     {
                    athletics:       'Athletik',
                    acrobatics:      'Akrobatik',
                    sleigh_of_hands: 'Fingerfertigkeit',
                    stealth:         'Heimlichkeit',
                    arcane:          'Arkane Kunde',
                    history:         'Geschichte',
                    investigation:   'Nachforschungen',
                    nature:          'Naturkunde',
                    religion:        'Religion',
                    medicine:        'Heilkunde',
                    animal_handling: 'Mit Tieren umgehen',
                    insight:         'Motiv erkennen',
                    survival:        'Überlebenskunst',
                    perception:      'Wahrnehmung',
                    performance:     'Auftreten',
                    intimidation:    'Einschüchtern',
                    deception:       'Täuschen',
                    persuasion:      'Überzeugen'
                },
                saves:           {},
                dsSuccess1:      0,
                dsSuccess2:      0,
                dsSuccess3:      0,
                dsFail1:         0,
                dsFail2:         0,
                dsFail3:         0,
                casterAttribute: '--',
                spellDifficulty: '--',
                spellBonus:      '--',
                maxSpellLevel:   10,
                currentSpell:    null,
            }
        },

        computed: {
            levels:      function() {
                let res = [];
                let i;
                for (i = 1; i < 21; i++) {
                    res.push({
                        id:   i,
                        name: i
                    });
                }
                return res;
            },
            classSpells: function() {
                switch (this.c.char_class_id) {

                    case 2:
                        return this.spells['bard'];
                    case 3:
                        return this.spells['druid'];
                    case 4:
                        return this.spells['warlock'];
                    case 6:
                        return this.spells['cleric'];
                    case 7:
                        return this.spells['wizard'];
                    case 9:
                        return this.spells['paladin'];
                    case 11:
                        return this.spells['ranger'];
                    case 12:
                        return this.spells['sorcerer'];
                    default:
                        return [];
                }
            }
        },

        methods: {
            displaySpell:       function(spell) {
                this.currentSpell = spell;
            },
            getCasterAttribute: function() {
                switch (parseInt(this.c.char_class_id)) {
                    case 2:
                    case 4:
                    case 9:
                    case 12:
                        return 'CH';
                    case 3:
                    case 6:
                    case 11:
                        return 'WE';
                    case 7:
                        return 'IN';
                    default:
                        return '--';

                }
            },
            getSpellDifficulty: function() {
                switch (parseInt(this.c.char_class_id)) {
                    case 2:
                    case 4:
                    case 9:
                    case 12:
                        return 8 + this.bonus.charisma + this.c.proficiency_bonus;
                    case 3:
                    case 6:
                    case 11:
                        return 8 + this.bonus.wisdom + this.c.proficiency_bonus;
                    case 7:
                        return 8 + this.bonus.intelligence + this.c.proficiency_bonus;
                    default:
                        return '--';
                }
            },
            getSpellBonus:      function() {
                switch (parseInt(this.c.char_class_id)) {
                    case 2:
                    case 4:
                    case 9:
                    case 12:
                        return this.bonus.charisma;
                    case 3:
                    case 6:
                    case 11:
                        return this.bonus.wisdom;
                    case 7:
                        return this.bonus.intelligence;
                    default:
                        return '--';

                }
            },
            setDeathSave:       function() {
                if (this.dsSuccess1) {
                    this.c.death_save_success = 1;
                }
                if (this.dsSuccess2) {
                    this.dsSuccess1           = true;
                    this.c.death_save_success = 2;
                }
                if (this.dsSuccess3) {
                    this.dsSuccess1           = true;
                    this.dsSuccess2           = true;
                    this.c.death_save_success = 3;
                }
                if (this.dsFail1) {
                    this.c.death_save_fail = 1;
                }
                if (this.dsFail2) {
                    this.dsFail1           = true;
                    this.c.death_save_fail = 2;
                }
                if (this.dsFail3) {
                    this.dsFail1           = true;
                    this.dsFail2           = true;
                    this.c.death_save_fail = 3;
                }
            },
            addSign:            function(num) {
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

            attackBonus(attr, prof) {
                try {
                    let bonus = this.bonus[attr] + (prof ? this.c.proficiency_bonus : 0);
                    if (isNaN(bonus)) {
                        bonus = 0;
                    }

                    return bonus;
                } catch (e) {
                    return 0;
                }
            },

            updateAttacks: function() {
                let i, a, newAttacks;
                console.log(typeof this.c.attacks);
                if (typeof this.c.attacks !== 'object' || this.c.attacks === null) {
                    this.c.attacks = [];
                }
                newAttacks = [];
                for (i = 0; i < this.c.attacks.length; i++) {
                    a = this.c.attacks[i];
                    if (a.name !== '' || a.damage !== '' || a.bonus !== '') {
                        newAttacks.push(a);
                    }
                }
                newAttacks.push({
                    name: '', damage: '', bonus: ''
                });
                console.log('New', newAttacks);
                this.c.attacks = newAttacks;
            },

            updateSave:  function(attribute, value) {
                this.c['has_' + attribute + '_save'] = value;
                this.recalculate();
            },
            updateSkill: function(skill, value) {
                this.c['has_' + skill] = value;
                this.recalculate();
            },
            updateLevel: function(value) {
                this.c.level = parseInt(value);
                this.recalculate();
            },
            recalculate: function() {
                let i, val, attr, skill;

                this.c.proficiency_bonus = Math.floor(parseInt(this.c.level) / 5) + 2;
                this.saves               = {};
                this.bonus               = {};
                this.skillBonus          = {};
                if (this.c.spells === null) {
                    this.c.spells = [];
                    for (i = 0; i < 11; i++) {
                        this.c.spells.push({
                            text:  '',
                            slots: 0
                        });
                    }
                }
                for (i = 0; i < this.attributes.length; i++) {
                    attr = this.attributes[i];
                    val  = parseInt(this.c[attr]);
                    if (isNaN(val)) {
                        val = 0;
                    }
                    this.bonus[attr] = Math.floor((val - 10) / 2);

                    this.saves[attr] = parseInt(this.bonus[attr]) + (this.c['has_' + attr + '_save'] ? parseInt(this.c.proficiency_bonus) : 0);
                }
                for (attr in this.skills) {
                    for (i = 0; i < this.skills[attr].length; i++) {
                        skill                  = this.skills[attr][i];
                        this.skillBonus[skill] = this.bonus[attr] + (this.c['has_' + skill] ? parseInt(this.c.proficiency_bonus) : 0);
                    }
                }
                this.updateAttacks();
                this.casterAttribute = this.getCasterAttribute();
                this.spellBonus      = this.getSpellBonus();
                this.spellDifficulty = this.getSpellDifficulty();
            },

            setTab:          function(tab) {
                this.activeTab = tab;
            },
            switchTab:       function(tab) {
                return {
                    display: tab === this.activeTab ? 'block' : 'none',
                }
            },
            switchTabHeader: function(tab) {
                return {
                    'nav-link': true,
                    'active':   tab === this.activeTab
                }
            },
        },
        created: function() {
            let comp = this;
            setInterval(function() {
                let url = '/char';
                if (comp.c.id) {
                    url += '/' + comp.c.id;
                }
                axios.post(url, {'c': comp.c}).then(function(answer) {
                    comp.c.id = answer.data;
                });
            }, 1000)
        },
    }
</script>

<style scoped>

</style>
