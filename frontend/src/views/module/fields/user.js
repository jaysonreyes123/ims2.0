export const user_fields = [
    {
        block_name:"Basic Information",
        fields:[
            {
                label:"Name",
                name:"name",
                type:"text",
                default:"",
                required:true,
                readonly:false
            },
            {
                label:"Email",
                name:"email",
                type:"text",
                default:"",
                required:true,
                readonly:false
            },
            {
                label:"Role",
                name:"roles_picklist",
                type:"picklist",
                default:1,
                required:true,
                readonly:false
            },
            {
                label:"Password",
                name:"password",
                type:"text",
                default:"",
                required:true,
                readonly:false
            },
        ]
    },
    {
        block_name:"Module Privileges",
        fields:[
            {
                label:"Incident",
                name:"user_privileges.incidents",
                type:"checkbox",
                default:false,
                required:false,
                readonly:false
            },
            {
                label:"Resources",
                name:"user_privileges.resources",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"Pre Plan",
                name:"user_privileges.preplans",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"Contact",
                name:"user_privileges.contacts",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"Agency",
                name:"user_privileges.agencies",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"Responder",
                name:"user_privileges.responders",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"Incident Map",
                name:"user_privileges.incident_map",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"Heat Map",
                name:"user_privileges.heat_map",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"Call Logs",
                name:"user_privileges.call_logs",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
            {
                label:"User",
                name:"user_privileges.users",
                type:"checkbox",
                default:true,
                required:false,
                readonly:false
            },
        ]
    },
];