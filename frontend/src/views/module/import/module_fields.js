export const incident_fields=
[
    {
        label:"Incident Type",
        name:"incident_types_picklist",
        type:"picklist",
        required:false,
        duplicate_handling:true,
    }, 
    {
        label:"Time of incident",
        name:"time_of_incident",
        type:"time",
        required:false,
        duplicate_handling:false,
    }, 
    {
        label:"Street name",
        name:"street_name",
        type:"text",
        required:false,
        duplicate_handling:true,
    }, 
    {
        label:"Date of incident",
        name:"date_of_incident",
        type:"date",
        required:false,
        duplicate_handling:false,
    }, 
    {
        label:"Incident Status",
        name:"incident_statuses_picklist",
        type:"picklist",
        required:false,
        duplicate_handling:true,
    },  
    {
        label:"Incident Priority",
        name:"incident_priorities_picklist",
        type:"picklist",
        required:false,
        duplicate_handling:true,
    }, 
    {
        label:"Notes/Remarks",
        name:"remarks",
        type:"text",
        required:false,
        duplicate_handling:true,
    }, 
]

export const resources_fields=
[
    {
        label:"Resources Name",
        name:"resources_name",
        type:"text",
        required:true,
        duplicate_handling:true,
    }, 
    {
        label:"Coodinates",
        name:"coordinates",
        type:"text",
        required:true,
        duplicate_handling:true,
    },   
]