function utility() {
    console.log("Programmer A calling")
}

utility()

function utility() {
    console.log("Programmer b calling")
}

utility()

//-----------------> Above Error Sloved by IIFE Functions As below

//  1) Sloutions 1
var com = {}
com.mydomain = {}

// Programmer A
com.mydomain.aprogarmmer = {}
// Programmer B
com.mydomain.bprogrammer = {}

console.log("------------------\n Sloutions 1 \n")

com.mydomain.aprogarmmer.utility = function () {
    console.log("IIFE: Programmer A Calling");
}

com.mydomain.aprogarmmer.utility()

com.mydomain.bprogrammer.utility = function () {
    console.log("IIFE: Programmer B Calling ")
}

com.mydomain.bprogrammer.utility()


    // 2) Sloutions 2 : slef calling functions or slef execute

    (function () {

        var com = {}
        com.mydomain = {}

        // Programmer A
        com.mydomain.aprogarmmer = {}
        // Programmer B
        com.mydomain.bprogrammer = {}

        console.log("------------------\nSlef Execute Functions")

        com.mydomain.aprogarmmer.utility = function () {
            console.log("IIFE: Programmer A Calling");
        }

        com.mydomain.aprogarmmer.utility()

        com.mydomain.bprogrammer.utility = function () {
            console.log("IIFE: Programmer B Calling ")
        }

        com.mydomain.bprogrammer.utility()

    }())