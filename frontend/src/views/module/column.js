export const columns = {
  incidents:[
    {
      label: "No.",
      field: "incident_no",
      name:"incident_no"
    },
    {
      label: "Date of incident",
      field: "date_of_incident",
      name: "date_of_incident"
    },
    {
      label: "Incident type",
      field: "incident_types.label",
      name: "incident_types_picklist"
    },
    {
      label: "Incident status",
      field: "incident_statuses.label",
      name: "incident_statuses_picklist"
    },
    {
      label: "Action",
      field: "action",
    },
  ],
  resources:[
    {
      label: "Resources Name",
      field: "resources_name",
      name: "resources_name",
    },
    {
      label: "Resources Type",
      field: "resources_types.label",
      name: "resources_types_picklist",
    },
    {
      label: "Resources Status",
      field: "resources_statuses.label",
      name: "resources_statuses_picklist",
    },
    {
      label: "Action",
      field: "action",
    },
  ],
  preplans:[
    {
      label: "Pre Plan Name",
      field: "pre_plan_name",
      name: "pre_plan_name",
    },
    {
      label: "Action",
      field: "action",
    },
  ],
  contacts:[
    {
      label: "First Name",
      field: "firstname",
      name: "firstname",
    },
    {
      label: "Last Name",
      field: "lastname",
      name: "lastname",
    },
    {
      label: "Action",
      field: "action",
    },
  ],
  agencies:[
    {
      label: "Agency Name",
      field: "agency_name",
      name: "agency_name",
    },
    {
      label: "Action",
      field: "action",
    },
  ],
  responders:[
    {
      label: "Firstname",
      field: "firstname",
      name: "firstname",
    },
    {
      label: "Action",
      field: "action",
    },
  ] ,
  call_logs:[
    {
      label: "Date and Time",
      field: "date_and_time",
      name: "date_and_time",
    },
    {
      label: "Action",
      field: "action",
    },
  ],
  users:[
    {
      label: "Name",
      field: "name",
      name: "name",
    },
    {
      label: "Email",
      field: "email",
      name: "email",
    },
    {
      label: "Role",
      field: "roles.label",
      name:  "roles_picklist"
    },
    {
      label: "Action",
      field: "action",
    },
  ]
}