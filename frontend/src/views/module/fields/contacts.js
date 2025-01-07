export const contacts_field = [
    {
        block_name:"Basic information",
        fields:[
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
                label:"Mobile No",
                name:"mobile",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Landline No",
                name:"landline",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Primary Email",
                name:"email",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Date of Birth",
                name:"date_of_birth",
                type:"date",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Caller Type",
                name:"caller_types_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
        ]
    },
    {
        block_name:"Address Details",
        fields:[
            {
                label:"Municipality",
                name:"municipalities_picklist",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Barangay",
                name:"barangays_picklist",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Street Name",
                name:"street_name",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
        ]
    }
]