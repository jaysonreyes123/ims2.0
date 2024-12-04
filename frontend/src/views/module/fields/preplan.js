export const preplan_fields = [
    {
        block_name:"Incident Details",
        fields:[
            {
                label:"Pre Plan Name",
                name:"pre_plan_name",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Incident Type",
                name:"incident_type",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Classification",
                name:"pre_plan_classifications_picklist",
                type:"picklist",
                default:"",
                required:false,
                readonly:false
            },
        ]
    },
    {
        block_name:"Response Procedure",
        fields:[
            {
                label:"Initial Assessment",
                name:"initial_assessment",
                type:"textarea",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Response Action",
                name:"response_action",
                type:"textarea",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Classification.",
                name:"classification",
                type:"textarea",
                default:"",
                required:false,
                readonly:false
            },
        ]
    },
    {
        block_name:"Roles and Responsibilities",
        fields:[
            {
                label:"Incident Manager",
                name:"incident_manager",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Incident Responder",
                name:"incident_responder",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Support Staff",
                name:"support_staff",
                type:"text",
                default:"",
                required:false,
                readonly:false
            },
        ]
    },
    {
        block_name:"Resource Allocation",
        fields:[
            {
                label:"Tools and Equipment",
                name:"tools_and_equipment",
                type:"textarea",
                default:"",
                required:false,
                readonly:false
            },
            {
                label:"Personnel",
                name:"personnel",
                type:"textarea",
                default:"",
                required:false,
                readonly:false
            },
        ]
    },
];