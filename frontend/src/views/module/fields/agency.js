export const agency_fields = [
    {
        block_name:"Basic Information",
        fields:[
            {
                label:"Agency Name",
                name:"agency_name",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Contact No. 1",
                name:"contact_no_1",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Contact No. 2",
                name:"contact_no_2",
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
                label:"Contact Persion",
                name:"contact_person",
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
];