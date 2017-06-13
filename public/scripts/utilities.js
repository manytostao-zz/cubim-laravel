/**
 * Created by osmany.torres on 6/12/2017.
 */
'use strict';

var utilities = function () {

    var _getCubanFormattedDate = function (plusDays, plusMonths, plusYears) {
        var today = new Date();
        if (plusDays === undefined) {
            plusDays = 0;
        }
        if (plusMonths === undefined) {
            plusMonths = 0;
        }
        if (plusYears === undefined) {
            plusYears = 0;
        }
        var dd = today.getDate() + plusDays;
        var mm = today.getMonth() + 1 + plusMonths; //January is 0!
        var yyyy = today.getFullYear() + plusYears;

        if (dd < 10) {
            dd = '0' + dd
        }

        if (mm < 10) {
            mm = '0' + mm
        }

        today = dd + '/' + mm + '/' + yyyy;
        return today;
    };

    return {
        getCubanFormattedDate: function (plusDays, plusMonths, plusYears) {
            return _getCubanFormattedDate(plusDays, plusMonths, plusYears);
        }
    }
}();