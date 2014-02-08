// borrowed from StackOverflow
if (typeof Object.create !== 'function') {
    Object.create = function (o) {
        function F() {}  // empty constructor
        F.prototype = o; // set base object as prototype
        return new F();  // return empty object with right [[Prototype]]
    };
}

// CC-SA Romain Schmitz
var OperationFactory = {
    unaryOperation: {
        type: 'unaryOperation',
        operator: '',
        val: null,
        calculate: function() {
            return null;
        }
    },
    binaryOperation: {
        type: 'binaryOperation',
        operator: '',
        left: null,
        right: null,
        calculate: function() {
            return null;
        }
    },
    createAns: function() {
        var AnsOperation = Object.create(this.unaryOperation);
        AnsOperation.calculate = function(){
            return this.val;
        }
        return AnsOperation;
    },
    createPlus: function(){
        var PlusOperation = Object.create(this.binaryOperation);
        PlusOperation.type = 'PlusOperation';
        PlusOperation.operator = '+';
        PlusOperation.calculate = function(){
            return this.left + this.right;
        };
        return PlusOperation;
    },
    createMinus: function(){
        var MinusOperation = Object.create(this.binaryOperation);
        MinusOperation.type = 'MinusOperation';
        MinusOperation.operator = '-';
        MinusOperation.calculate = function(){
            return this.left - this.right;
        };
        return MinusOperation;
    },
    createMultiply: function(){
        var MultiplyOperation = Object.create(this.binaryOperation);
        MultiplyOperation.type = 'MultiplyOperation';
        MultiplyOperation.operator = '*';
        MultiplyOperation.calculate = function(){
            return this.left * this.right;
        };
        return MultiplyOperation;
    },
    createDivide: function(){
        var DivideOperation = Object.create(this.binaryOperation);
        DivideOperation.type = 'DivideOperation';
        DivideOperation.operator = '/';
        DivideOperation.calculate = function(){
            return this.left / this.right;
        };
        return DivideOperation;
    }
}