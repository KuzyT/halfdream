<template>
    <div class="datepicker control" :class="[size, {'is-expanded': expanded}]">
        <b-dropdown
                v-if="!isMobile || inline"
                ref="dropdown"
                :position="position"
                :disabled="disabled"
                :inline="inline">
            <b-input
                    ref="input"
                    slot="trigger"
                    autocomplete="off"
                    :value="formatValue(dateSelected)"
                    :placeholder="placeholder"
                    :size="size"
                    :icon="icon"
                    :icon-pack="iconPack"
                    :rounded="rounded"
                    :loading="loading"
                    :disabled="disabled"
                    :readonly="!editable"
                    v-bind="$attrs"
                    @change.native="onChange($event.target.value)"
                    @focus="$emit('focus', $event)"
                    @blur="$emit('blur', $event) && checkHtml5Validity()"/>

            <b-dropdown-item :disabled="disabled" custom>

                <b-datepicker v-model="date"
                              :day-names="dayNames"
                              :month-names="monthNames"
                              :first-day-of-week="firstDayOfWeek"
                              :min-date="minDate"
                              :max-date="maxDate"
                              :focused="focusedDateData"
                              :disabled="disabled"
                              :unselectable-dates="unselectableDates"
                              :unselectable-days-of-week="unselectableDaysOfWeek"
                              :selectable-dates="selectableDates"
                              :events="events"
                              :indicators="indicators"
                              :date-creator="dateCreator"
                              :pack="iconPack"
                              :size="size"
                              :readonly="!editable"
                              :placeholder="placeholder"
                              inline>
                </b-datepicker>



                <footer class="datepicker-footer">
                    <b-timepicker v-model="time"
                                  :placeholder="placeholder"
                                  :size="size"
                                  :icon="icon"
                                  :icon-pack="iconPack"
                                  :loading="loading"
                                  :disabled="disabled"
                                  :readonly="!editable"
                                  :rounded="rounded"
                                  inline>
                    </b-timepicker>
                </footer>

                <footer
                        v-if="$slots.default !== undefined && $slots.default.length"
                        class="datepicker-footer">
                    <slot/>
                </footer>
            </b-dropdown-item>
        </b-dropdown>
    </div>

</template>

<script>
    import BDatepicker from "buefy/src/components/datepicker/Datepicker";
    import BTimepicker from "buefy/src/components/timepicker/Timepicker";

    import FormElementMixin from 'buefy/src/utils/FormElementMixin'
    import { isMobile } from 'buefy/src/utils/helpers'
    import config from 'buefy/src/utils/config'
    import Dropdown from 'buefy/src/components/dropdown/Dropdown'
    import DropdownItem from 'buefy/src/components/dropdown/DropdownItem'
    import Input from 'buefy/src/components/input/Input'
    import Field from 'buefy/src/components/field/Field'
    import Select from 'buefy/src/components/select/Select'
    import Icon from 'buefy/src/components/icon/Icon'

    // todo - now it is hardcoded in component because of Buefy global config O_o
    config.defaultIconPack = 'fas';
    config.defaultIconComponent = 'font-awesome-icon';

    // todo - well, it is some (many) mess here from datepicker and timepicker
    const AM = 'AM'
    const PM = 'PM'
    const HOUR_FORMAT_24 = '24'
    const HOUR_FORMAT_12 = '12'
    const formatNumber = (value) => {
        return (value < 10 ? '0' : '') + value
    }
    const timeFormatter = (date, vm) => {
        let hours = date.getHours()
        const minutes = date.getMinutes()
        let am = false
        if (vm.hourFormat === HOUR_FORMAT_12) {
            am = hours < 12
            if (hours > 12) {
                hours -= 12
            } else if (hours === 0) {
                hours = 12
            }
        }
        return formatNumber(hours) + ':' + formatNumber(minutes) +
            (vm.hourFormat === HOUR_FORMAT_12 ? (' ' + (am ? AM : PM)) : '')
    }
    const timeParser = (date, vm) => {
        if (date) {
            let dateString = date
            let am = false
            if (vm.hourFormat === HOUR_FORMAT_12) {
                const dateString12 = date.split(' ')
                dateString = dateString12[0]
                am = dateString12[1] === AM
            }
            const time = dateString.split(':')
            let hours = parseInt(time[0], 10)
            const minutes = parseInt(time[1], 10)
            if (isNaN(hours) || hours < 0 || hours > 23 ||
                (vm.hourFormat === HOUR_FORMAT_12 && (hours < 1 || hours > 12)) ||
                isNaN(minutes) || minutes < 0 || minutes > 59) {
                return null
            }
            let d = null
            if (vm.dateSelected && !isNaN(vm.dateSelected)) {
                d = new Date(vm.dateSelected)
            } else {
                d = new Date()
                d.setMilliseconds(0)
                d.setSeconds(0)
            }
            d.setMinutes(minutes)
            if (vm.hourFormat === HOUR_FORMAT_12) {
                if (am && hours === 12) {
                    hours = 0
                } else if (!am && hours !== 12) {
                    hours += 12
                }
            }
            d.setHours(hours)
            return d
        }
        return null
    }

    export default {
        name: 'DateTime',

        components: {
            BTimepicker,
            BDatepicker,
            [Input.name]: Input,
            [Field.name]: Field,
            [Select.name]: Select,
            [Icon.name]: Icon,
            [Dropdown.name]: Dropdown,
            [DropdownItem.name]: DropdownItem,

        },

        mixins: [FormElementMixin],
        inheritAttrs: false,

        props: {
            value: Date,
            dayNames: {
                type: Array,
                default: () => {
                    if (Array.isArray(config.defaultDayNames)) {
                        return config.defaultDayNames
                    } else {
                        return [
                            'Su',
                            'M',
                            'Tu',
                            'W',
                            'Th',
                            'F',
                            'S'
                        ]
                    }
                }
            },
            monthNames: {
                type: Array,
                default: () => {
                    if (Array.isArray(config.defaultMonthNames)) {
                        return config.defaultMonthNames
                    } else {
                        return [
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'August',
                            'September',
                            'October',
                            'November',
                            'December'
                        ]
                    }
                }
            },
            firstDayOfWeek: {
                type: Number,
                default: () => {
                    if (typeof config.defaultFirstDayOfWeek === 'number') {
                        return config.defaultFirstDayOfWeek
                    } else {
                        return 0
                    }
                }
            },
            inline: Boolean,
            minDate: Date,
            maxDate: Date,
            focusedDate: Date,
            placeholder: String,
            editable: Boolean,
            disabled: Boolean,
            unselectableDates: Array,
            unselectableDaysOfWeek: {
                type: Array,
                default: () => { return config.defaultUnselectableDaysOfWeek }
            },
            selectableDates: Array,
            dateFormatter: {
                type: Function,
                default: (date) => {
                    if (typeof config.defaultDateFormatter === 'function') {
                        return config.defaultDateFormatter(date)
                    } else {
                        const yyyyMMdd = date.getFullYear() +
                            '/' + (date.getMonth() + 1) +
                            '/' + date.getDate();
                        const d = new Date(yyyyMMdd);
                        return d.toLocaleDateString();
                    }
                }
            },
            dateParser: {
                type: Function,
                default: (date) => {
                    if (typeof config.defaultDateParser === 'function') {
                        return config.defaultDateParser(date)
                    } else {
                        return new Date(Date.parse(date))
                    }
                }
            },
            dateCreator: {
                type: Function,
                default: () => {
                    if (typeof config.defaultDateCreator === 'function') {
                        return config.defaultDateCreator()
                    } else {
                        return new Date()
                    }
                }
            },
            mobileNative: {
                type: Boolean,
                default: () => {
                    return config.defaultDatepickerMobileNative
                }
            },
            position: String,
            events: Array,
            indicators: {
                type: String,
                default: 'dots'
            },

            hourFormat: {
                type: String,
                default: HOUR_FORMAT_24,
                validator: (value) => {
                    return value === HOUR_FORMAT_24 || value === HOUR_FORMAT_12
                }
            },
            timeFormatter: {
                type: Function,
                default: (date, vm) => {
                    if (typeof config.defaultTimeFormatter === 'function') {
                        return config.defaultTimeFormatter(date)
                    } else {
                        return timeFormatter(date, vm)
                    }
                }
            },
            timeParser: {
                type: Function,
                default: (date, vm) => {
                    if (typeof config.defaultTimeParser === 'function') {
                        return config.defaultTimeParser(date)
                    } else {
                        return timeParser(date, vm)
                    }
                }
            },
        },

        data() {
            const focusedDate = this.value || this.focusedDate || this.dateCreator()
            return {
                dateSelected: this.value,

                focusedDateData: {
                    month: focusedDate.getMonth(),
                    year: focusedDate.getFullYear()
                },
                _elementRef: 'input',
                _isDatepicker: true,

                date: this.value,
                time: this.value,
            }
        },

        computed: {
            isMobile() {
                return this.mobileNative && isMobile.any()
            }
        },

        watch: {
            /*
            * Emit input event with selected date as payload, set isActive to false.
            * Update internal focusedDateData
            */
            dateSelected(value) {
                const currentDate = !value ? this.dateCreator() : value
                this.focusedDateData = {
                    month: currentDate.getMonth(),
                    year: currentDate.getFullYear()
                }
                this.$emit('input', value)
                if (this.$refs.dropdown) {
                    this.$refs.dropdown.isActive = false
                }
            },
            /**
             * When v-model is changed:
             *   1. Update internal value.
             *   2. If it's invalid, validate again.
             */
            value(value) {
                this.dateSelected = value;
                this.date = value;
                this.time = value;
                !this.isValid && this.$refs.input.checkHtml5Validity()
            },
            focusedDate(value) {
                if (value) {
                    this.focusedDateData = {
                        month: value.getMonth(),
                        year: value.getFullYear()
                    }
                }
            },
            date(value) {
                if (value && this.dateSelected !== value) {
                    var needTimeFix = false;
                    if (this.dateSelected) {
                        needTimeFix = true;
                        var hours = this.dateSelected.getHours();
                        var minutes = this.dateSelected.getMinutes();
                    }

                    this.dateSelected = value;
                    this.time = value;

                    if (needTimeFix) {
                        this.time.setHours(hours);
                        this.time.setMinutes(minutes);
                    }
                }
            },
            time(value) {
                if (value && this.dateSelected !== value) {
                    this.dateSelected = value;
                    this.date = value;
                }
            },
        },
        methods: {
            /*
            * Emit input event with selected date as payload for v-model in parent
            */
            updateSelectedDate(date) {
                this.dateSelected = date
            },
            /*
            * Parse string into date
            */
            onChange(value) {
                const date = this.dateParser(value)
                if (date && !isNaN(date)) {
                    this.dateSelected = date
                } else {
                    // Force refresh input value when not valid date
                    this.dateSelected = null
                    this.$refs.input.newValue = this.dateSelected
                }
            },
            /*
            * Format date into string
            */
            formatValue(value) {
                if (value && !isNaN(value)) {
                    return this.dateFormatter(value) + ' ' + this.timeFormatter(value, this)
                } else {
                    return null
                }
            },
            /*
            * Format date into string 'YYYY-MM-DD'
            */
            formatYYYYMMDD(value) {
                const date = new Date(value)
                if (value && !isNaN(date)) {
                    const year = date.getFullYear()
                    const month = date.getMonth() + 1
                    const day = date.getDate()
                    return year + '-' +
                        ((month < 10 ? '0' : '') + month) + '-' +
                        ((day < 10 ? '0' : '') + day)
                }
                return ''
            },

            /*
            * Format date into string 'HH-MM-SS'
            */
            formatHHMMSS(value) {
                const date = new Date(value)
                if (value && !isNaN(date)) {
                    const hours = date.getHours()
                    const minutes = date.getMinutes()
                    return formatNumber(hours) + ':' +
                        formatNumber(minutes) + ':00'
                }
                return ''
            },


            formatDATETIME(value) {
              var date = this.formatYYYYMMDD(value);
              var time = this.formatHHMMSS(value);
              var datetime = date ? date : '';
              if (time) {
                  datetime = datetime ? datetime + ' ' + time : time;
              }
              return datetime;
            },

            /*
            * Parse date from string
            */
            onChangeNativePicker(event) {
                // todo - maybe not worked now? Well, at this time must be select by form
                const date = event.target.value;
                this.dateSelected = date ? new Date(date.replace(/-/g, '/').replace(/\./g, '/')) : null
                this.date = this.dateSelected;
                this.time = this.dateSelected;
            }

        }
    }
</script>