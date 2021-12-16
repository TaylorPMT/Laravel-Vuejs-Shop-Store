export default {
    data() {
        return {
            listSelected: [],
            checkAll: false,
        }
    },
    methods: {
        formatNumberCMS(val) {
            return val.toString().replace(/,/g, "");
        },
        formatAll(value, options) {
            let vm = this;
            options.currency = options && options.currency ? options.currency : false;
            //options.format = options && options.format ? options.format : '';
            if (options.currency == false) {
                var _monthNames = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
                var _dayNames = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
                var _year = value.getFullYear();
                var _month = value.getMonth();
                var _day = value.getDay();
                var _date = value.getDate();
                var _hours = value.getHours();
                var _minutes = value.getMinutes();
                var _seconds = value.getSeconds();

                if (!options.format) {
                    options.format = "DD/MM/YYYY";
                }
                let date = null;
                date = options.format.replace("YYYY", "{0}").replace("YY", "{1}").replace("Y", "{2}")
                    .replace("MMMM", "{3}").replace("MMM", "{4}").replace("MM", "{5}").replace("M", "{6}")
                    .replace("DDDD", "{7}").replace("DDD", "{8}").replace("DD", "{9}").replace("D", "{10}")
                    .replace("hh", "{11}").replace("h", "{12}").replace("HH", "{13}").replace("H", "{14}")
                    .replace("mm", "{15}").replace("m", "{16}")
                    .replace("ss", "{17}").replace("s", "{18}")
                    .replace("tt", "{19}").replace("t", "{20}");

                if (date.indexOf("{0}") > -1) {
                    date = date.replace("{0}", _year.toString());
                }
                if (date.indexOf("{1}") > -1) {
                    date = date.replace("{1}", _year.toString().substr(2, 2));
                }
                if (date.indexOf("{2}") > -1) {
                    date = date.replace("{2}", parseInt(_year.toString().substr(2, 2)).toString());
                }
                if (date.indexOf("{3}") > -1) {
                    date = date.replace("{3}", _monthNames[_month]);
                }
                if (date.indexOf("{4}") > -1) {
                    date = date.replace("{4}", _monthNames[_month].substr(0, 3));
                }
                if (date.indexOf("{5}") > -1) {
                    date = date.replace("{5}", (_month + 1).toString().padStart(2, '0'));
                }
                if (date.indexOf("{6}") > -1) {
                    date = date.replace("{6}", (_month + 1).toString());
                }
                if (date.indexOf("{7}") > -1) {
                    date = date.replace("{7}", _dayNames[_day]);
                }
                if (date.indexOf("{8}") > -1) {
                    date = date.replace("{8}", _dayNames[_day].substr(0, 3));
                }
                if (date.indexOf("{9}") > -1) {
                    date = date.replace("{9}", _date.toString().padStart(2, '0'));
                }
                if (date.indexOf("{10}") > -1) {
                    date = date.replace("{10}", _date.toString());
                }
                if (date.indexOf("{11}") > -1) {
                    var _h = _hours;
                    if (_hours > 12) {
                        _h -= 12;
                    }
                    if (_hours == 0) {
                        _h = 12;
                    }
                    date = date.replace("{11}", _h.toString().padStart(2, '0'));
                }
                if (date.indexOf("{12}") > -1) {
                    var _h = _hours;
                    if (_hours > 12) {
                        _h -= 12;
                    }
                    if (_hours == 0) {
                        _h = 12;
                    }
                    date = date.replace("{12}", _h.toString());
                }
                if (date.indexOf("{13}") > -1) {
                    date = date.replace("{13}", _hours.toString().padStart(2, '0'));
                }
                if (date.indexOf("{14}") > -1) {
                    date = date.replace("{14}", _hours.toString());
                }
                if (date.indexOf("{15}") > -1) {
                    date = date.replace("{15}", _minutes.toString().padStart(2, '0'));
                }
                if (date.indexOf("{16}") > -1) {
                    date = date.replace("{16}", _minutes.toString());
                }
                if (date.indexOf("{17}") > -1) {
                    date = date.replace("{17}", _seconds.toString().padStart(2, '0'));
                }
                if (date.indexOf("{18}") > -1) {
                    date = date.replace("{18}", _seconds.toString());
                }
                if (date.indexOf("{19}") > -1) {
                    if (_hours > 11) {
                        date = date.replace("{19}", "PM")
                    } else {
                        date = date.replace("{19}", "AM");
                    }
                }
                if (date.indexOf("{20}") > -1) {
                    if (_hours > 11) {
                        date = date.replace("{20}", "P")
                    } else {
                        date = date.replace("{20}", "A");
                    }
                }
                return date;
            } else {
                let val = parseInt(value);
                let isNumber = Number.isInteger(val);
                if (isNumber == false) {
                    alert(`${value} đây không phải là số!`)
                } else {
                    val = val.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, options.format);
                    return val;
                }
            }
        },
        getDDMMYYYY(val) {
            let date = new Date(val);
            return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        },
        getMMDDYYYY(val) {
            let date = new Date(val);
            return (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
        },
        getYYYYMMDD(val) {
            let date = new Date(val);
            return date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate();
        },
        readOnlyJson(o, ...list) {
            let objForm = {};
            let form = o;
            for (let key in list) {
                let value = list[key];
                if (key == 'id' && typeof key == 'number') {
                    continue;
                };
                if (value in form) {
                    objForm[value] = form[value] && form[value].toString().indexOf(',') > -1 && !isNaN(form[value].toString().split(',').join('')) ? parseInt(form[value].toString().split(',').join('')) : form[value];
                }
            }
            return objForm;
        },
        readOnlyArray(array, ...list) {
            let arrForm = [];
            if (array.length > 0) {
                arrForm = array.map(r => {
                    let obj = {};
                    if (list.length > 0) {
                        for (let key in list) {
                            let value = list[key];
                            if (value == 'id' && typeof r[value] == 'number') {
                                continue;
                            };
                            if (value in r) {
                                obj[value] = r[value] && r[value].toString().indexOf(',') > -1 && !isNaN(r[value].toString().split(',').join('')) ? parseInt(r[value].toString().split(',').join('')) : r[value];
                            }
                        }
                    };
                    return obj;
                })
            };
            return arrForm;
        },
        parseJSON(arr) {
            return JSON.parse(JSON.stringify(arr))
        },
        spaceEnterHandle(val) {
            let text = val.toLowerCase();
            text = text.replace(/\n/g, " ").replace(/\r?\n|\r/g, "");
            return text;
        },
        asset(path) {
            return new URL(path, DOMAIN)
        },
        url(path, host) {
            if (host == '') {
                host = DOMAIN;
            }
            return new URL(path, host);
        },

        imageUrl(url) {
            return `http://shop.vm:8081/frontend/` + url;
        },
        getMaxDate(year = 10) {
            let date = new Date();
            date.setFullYear(date.getFullYear() - year);
            return date.getMonth() + '/' + (date.getDate()) + '/' + (date.getFullYear());
        },
        getPathUrl() {
            let url = window.location.pathname.split('/');
            return {
                'path': url[url.length - 1],
                'id': url[url.length - 2],
            };
        },
        isEmpty(str) {
            return (!str || str.length === 0);
        },
        textEmpty(str) {
            return !str ? str : '';
        },
        confirm(str) {
            return confirm(str);
        },
        abort(status) {
            switch (status) {
                case 404:
                    return this.$router.push({ name: '404' });
            }
            return this.$router.push({ name: '404' });
        },
    },
    filters: {
        DDMMYYYY(val) {
            let date = new Date(val);
            return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        },
        MMDDYYYY(val) {
            let date = new Date(val);
            return (date.getMonth() + 1) + date.getDate() + '/' + '/' + date.getFullYear();
        },
        YYYYMMDD(val) {
            let date = new Date(val);
            return date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate();
        },
        formatMoney(val) {
            let value = val.toString().split(',').join('');
            value = Number(value);
            return new Intl.NumberFormat('de-DE', {
                style: 'currency',
                currency: 'VND'
            }).format(value);
        },
        formatNumber(val) {
            let value = val.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            return value;
        },
    },
    watch: {
        '$route' (to, from) {
            this.$store.commit('resetState')
        }
    },
}