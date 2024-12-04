export const incidents_field = [
    {
        block_name:"Incident Details",
        fields:[
            {
                label:"Incident ID(Auto Generate)",
                name:"incident_no",
                type:"text",
                default:"",
                required:false,
                readonly:true
            },
            {
                label:"Incident Type",
                name:"incident_types_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false,
            },
            {
                label:"Time of Incident",
                name:"time_of_incident",
                type:"time",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Date of Incident",
                name:"date_of_incident",
                type:"date",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Incident Status",
                name:"incident_statuses_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Incident Priority",
                name:"incident_priorities_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Notes/Remarks",
                name:"remarks",
                type:"textarea",
                default:"",
                required:false,
                readonly:false
            },
        ]
    },
    {
        block_name:"Location Details",
        fields:[
            {
                label:"Location",
                name:"location",
                type:"text",
                default:"",
                required:false,
                readonly:false,
                duplicate_handling:true
            },
            {
                label:"Street Name",
                name:"street_name",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Nearest Landmark",
                name:"nearest_landmark",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Coordinates",
                name:"coordinates",
                type:"text",
                default:"",
                required:false,
                readonly:true
            },
        ]
    },
    {
        block_name:"Caller Details",
        fields:[
            {
                label:"First Name",
                name:"caller_firstname",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Last Name",
                name:"caller_lastname",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Contact No",
                name:"caller_contact",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
        ]
    },
    {
        block_name:"Responder",
        fields:[
            {
                label:"Responder Team",
                name:"assigned_team",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Assigned By",
                name:"response_team",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Assigned Team",
                name:"assigned_team",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
        ]
    }

]