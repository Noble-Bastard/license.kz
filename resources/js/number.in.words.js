var TRIPLET_NAMES = [
        undefined,
        ['тысяча', 'тысячи', 'тысяч'],
        ['миллион', 'миллиона', 'миллионов'],
        ['миллиард', 'миллиарда', 'миллиардов'],
        ['триллион', 'триллиона', 'триллионов'],
        ['квадрилион', 'квадрилиона', 'квадрилионов'],
    ],
    ZERO_NAME = 'нуль',
    ONE_THOUSANT_NAME = 'одна',
    TWO_THOUSANT_NAME = 'две',
    HUNDRED_NAMES = [
        undefined, 'сто', 'двести', 'триста', 'четыреста',
        'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот',
    ],
    TEN_NAMES = [
        undefined, undefined, 'двадцать', 'тридцать', 'сорок',
        'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто',
    ],
    UNIT_NAMES = [
        ZERO_NAME, 'один', 'два', 'три', 'четыре',
        'пять', 'шесть', 'семь', 'восемь', 'девять',
    ],
    TEN_UNIT_NAMES = [
        'десять', 'одиннадцать', 'двенадцать', 'тринадцать',
        'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать',
        'восемнадцать', 'девятнадцать',
    ],
    INPUT_VALUE_LIMIT = TRIPLET_NAMES.length * 3


function pluralEnding(number, variants) {
    var one = variants[0],
        two = variants[1],
        five = variants[2];
    number = Math.abs(number);
    number %= 100;
    if (number >= 5 && number <= 20) {
        return five;
    }
    number %= 10;
    if (number === 1) {
        return one;
    }
    if (number >= 2 && number <= 4) {
        return two;
    }
    return five;
}

function numberInWords(number) {
    var numberInWords = [],
        i,
        pos,
        length,
        tripletNames,
        tripletIndex,
        digitPosition,
        prevDigitValue;

    if (typeof(number) !== "string") {
        number = number + '';
    }

    length = number.length;

    for (i = 0; i < length; i += 1) {
        pos = length - 1 - i;
        tripletIndex = Math.floor(pos / 3);
        digitPosition = pos % 3;
        digitValue = parseInt(number[i]);

        if (digitPosition === 2) {
            if (digitValue) {
                numberInWords.push(HUNDRED_NAMES[digitValue]);
            }
            continue;
        }
        if (digitPosition === 1) {
            if (digitValue === 1) {
                numberInWords.push(TEN_UNIT_NAMES[parseInt(number[i + 1])])
            } else if (digitValue) {
                numberInWords.push(TEN_NAMES[digitValue])
            }
            continue
        }
        if (digitPosition === 0) {
            prevDigitValue = i - 1 >= 0
                ? parseInt(number[i - 1])
                : undefined;

            if (digitValue === 0) {
                if (length === 1) {
                    numberInWords.push(ZERO_NAME);
                }
            } else if (prevDigitValue && prevDigitValue !== 1
                    || !prevDigitValue) {

                let val = UNIT_NAMES[digitValue];
                if(tripletIndex === 1){
                    switch (digitValue) {
                        case 1:
                            val = ONE_THOUSANT_NAME;
                            break;
                        case 2:
                            val = TWO_THOUSANT_NAME;
                            break;
                    }
                }

                numberInWords.push(val)
            }

            tripletNames = TRIPLET_NAMES[tripletIndex];
            if (tripletNames) {

                if (prevDigitValue === 1) {
                    numberInWords.push(
                        pluralEnding(10 + digitValue, tripletNames));
                } else {
                    numberInWords.push(
                        pluralEnding(digitValue, tripletNames));
                }
            }
            continue;
        }
    }

    return numberInWords.join(' ');
}


var assert = require('assert');

assert.equal(numberInWords(0), 'нуль');
assert.equal(numberInWords(5), 'пять');
assert.equal(numberInWords(10), 'десять');
assert.equal(numberInWords(16), 'шестнадцать');
assert.equal(numberInWords(30), 'тридцать');
assert.equal(numberInWords(53), 'пятьдесят три');
assert.equal(numberInWords(100), 'сто');
assert.equal(numberInWords(111), 'сто одиннадцать');
assert.equal(numberInWords(123), 'сто двадцать три');
assert.equal(numberInWords(204), 'двести четыре');
assert.equal(numberInWords(300), 'триста');
assert.equal(numberInWords(1000), 'одна тысяча');
assert.equal(numberInWords(1400), 'одна тысяча четыреста');
assert.equal(numberInWords(83756), 'восемьдесят три тысячи семьсот пятьдесят шесть');
assert.equal(numberInWords(293111), 'двести девяносто три тысячи сто одиннадцать');
assert.equal(numberInWords(32001950), 'тридцать два миллиона одна тысяча девятьсот пятьдесят');

function num2word(value, unit1, unit2, unit3 ){

    if( (value % 100 >= 11) && (value % 100 <= 19) ){
        return unit3;
    }else{
        switch( value % 10 ){
            case 1:
                return unit1;
            case 2:case 3:case 4:
            return unit2;
            default:
                return unit3;
        }
    }
}
