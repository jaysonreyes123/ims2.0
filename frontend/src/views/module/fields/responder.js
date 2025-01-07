export const responder_fields = [
    {
        block_name:"Basic Information",
        fields:[
            {
                label:"Responder Type",
                name:"responder_types_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"First Name",
                name:"firstname",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Last Name",
                name:"lastname",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Contact No",
                name:"contact_no",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            // {
            //     label:"Middle Name",
            //     name:"middlename",
            //     type:"text",
            //     default:"",
            //     required:false,
            //     readonly:false
            // },
            // {
            //     label:"Assigned To",
            //     name:"assigned_to_picklist",
            //     type:"picklist",
            //     default:"",
            //     required:false,
            //     readonly:false
            // },
        ]
    },
    {
        block_name:"Login information",
        fields:[
            {
                label:"Email Address",
                name:"email_address",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Password",
                name:"password",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Assigned To",
                name:"assigned_to_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Status",
                name:"responder_statuses_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
        ]
    }
];