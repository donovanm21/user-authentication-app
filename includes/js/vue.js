// Vue Player Submition App
const app = new Vue({
    el: '#app-root',
    data: {
        globalvars: {
            app_id: null
        },
        // Vars for app
        membertype: 'client',
        clientDirWorkspace: 'Rondebosch',
        recordSelector: '25',
        globalvarsset: false,
        // Form Vars
        formVars: {
            // Client Form POST Vars
            clientcompany: "",
            clientcode: "",
            clientfirstname: "",
            clientlastname: "",
            clientemail: "",
            clientworkspace: "",
            clientextension: "",
            clientlandline: "",
            clientmobile: "",
            clientfpid: "",
            clientbirthday: "",
            clientdatejoined: "",
            clienttype: "",
            // Staff Form POST Vars
            staffFirstname: "",
            staffLastname: "",
            staffEmail: "",
            staffWorkspace: "",
            staffDesignation: "",
            staffExtension: "",
            staffMobile: "",
            staffFPID: "",
            staffBirthday: "",
            // Visitor Form POST Vars
            visitorCompanyFrom: "",
            visitorCompanyFor: "",
            visitorFirstname: "",
            visitorLastname: "",
            visitorEmail: "",
            visitorWorkspace: "",
            visitorMobile: "",
            visitorType: ""
        }
    },
    mounted() {
        if (localStorage.getItem('globalvars')) {
            try {
                this.globalvars = JSON.parse(localStorage.getItem('globalvars'))
            } catch(e) {
                localStorage.removeItem('globalvars')
            }
        }
        if (localStorage.getItem('formVars')) {
            try {
                this.formVars = JSON.parse(localStorage.getItem('formVars'))
            } catch(e) {
                localStorage.removeItem('formVars')
            }
        }
        if (localStorage.getItem('recordSelector')) {
            try {
                this.recordSelector = JSON.parse(localStorage.getItem('recordSelector'))
            } catch(e) {
                localStorage.removeItem('recordSelector')
            }
        }
        if (localStorage.getItem('clientDirWorkspace')) {
            try {
                this.clientDirWorkspace = JSON.parse(localStorage.getItem('clientDirWorkspace'))
            } catch(e) {
                localStorage.removeItem('clientDirWorkspace')
            }
        }
        if (localStorage.getItem('membertype')) {
            try {
                this.membertype = JSON.parse(localStorage.getItem('membertype'))
            } catch(e) {
                localStorage.removeItem('membertype')
            }
        }
        if (localStorage.getItem('globalvarsset')) {
            try {
                this.globalvarsset = JSON.parse(localStorage.getItem('globalvarsset'))
            } catch(e) {
                localStorage.removeItem('globalvarsset')
            }
        }
    },
    methods: {
        currentDate(){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = dd + '-' + mm + '-' + yyyy;
            return today
        },
        scrollToTop() {
            window.scrollTo(0,0);
        },
        onChange(event, prop, value) {
            console.log(event.target.value)
            this.setLocalStorage(prop, value)
        },
        setLocalStorage(parseItem, itemName) {
            const parseLocalStorage = JSON.stringify(parseItem)
            localStorage.setItem(itemName, parseLocalStorage)
        },
        memberFormSubmit(){
            this.setLocalStorage(this.formVars, 'formVars')
        },
        clearFormVars(){
            this.formVars = {}
            this.setLocalStorage(this.formVars, 'formVars')
            localStorage.removeItem('membertype')
            this.membertype = 'client'
        },
        addClient(){
            this.formVars = {}
            this.setLocalStorage(this.formVars, 'formVars')
            this.membertype = 'client'
            this.setLocalStorage(this.membertype, 'membertype')
            this.membertype = JSON.parse(localStorage.getItem('membertype'))
        }
    }
})
