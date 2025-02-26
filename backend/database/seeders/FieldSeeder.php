<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Field;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        $blocks = 
        [
             "incidents"    => [ "Incident Details","Location Details","Report Details","Responder","Incident Resolution"],
             "resources"    => [ "Resources Information","Location Details"],
             "preplans"     => ["Incident Details","Response Procedure","Roles and Responsibilities","Resource Allocation"],
             "contacts"     => ["Basic information","Address Details"],
             "agencies"     => ["Basic Information","Address Details"],
             "responders"   => ["Basic Information","Login information"],
             "call_logs"   =>  ["Basic Information"],
             "reports"      => ["Report Details"],
             "users"      => ["Basic Information","User Privileges"],
             "media"      => ["Basic Information","File"],
             "tasks"      => ["Basic Information"],
        ];

        $fields =
        [ 
        "incidents" => 
        [
            0 => 
                [
                    [
                        "label" => "Incident ID(Auto Generate)",
                        "name"  => "incident_no",
                        "table"  => "incidents",
                        "type"  => "generate",
                        "readonly" => 1,
                        "column" => 1,
                        "display_type" => 3
                    ],
                    [
                        "label" => "Incident Type",
                        "name"  => "incident_types",
                        "table"  => "incidents",
                        "type"  => "dropdown",
                        "column" => 1
                    ],
                    [
                        "label" => "Time of Incident",
                        "name"  => "time_of_incident",
                        "table"  => "incidents",
                        "type"  => "time",
                    ],
                    [
                        "label" => "Date of Incident",
                        "name"  => "date_of_incident",
                        "table"  => "incidents",
                        "type"  => "date",
                    ],
                    [
                        "label" => "Incident Status",
                        "name"  => "incident_statuses",
                        "table" => "incidents",
                        "type"  => "dropdown",
                        "column" => 1
                    ],
                    [
                        "label" => "Incident Priority",
                        "name"  => "incident_priorities",
                        "table" => "incidents",
                        "type"  => "dropdown",
                        "column" => 1
                    ],
                    [
                        "label" => "Notes/Remarks",
                        "name"  => "remarks",
                        "table" => "incidents",
                        "type"  => "textarea",
                    ],
                ],
            1 =>
                [
                    [
                        "label" => "location",
                        "name"  => "location",
                        "table" => "incidents",
                        "type"  => "text",
                    ],
                    [
                        "label" => "Street Name",
                        "name"  => "street_name",
                        "table" => "incidents",
                        "type"  => "text",
                    ],
                    [
                        "label" => "Nearest Landmark",
                        "name"  => "nearest_landmark",
                        "table" => "incidents",
                        "type"  => "text",
                    ],
                    [
                        "label" => "Coordinates",
                        "name"  => "coordinates",
                        "table" => "incidents",
                        "type"  => "coordinates",
                        "readonly" => 1,
                        "required" => 1
                    ],
                ],
            2 =>
                [
                    [
                        "label" => "First Name",
                        "name"  => "caller_firstname",
                        "type"  => "text",
                        "table" => "incidents",
                    ], 
                    [
                        "label" => "Last Name",
                        "name"  => "caller_lastname",
                        "type"  => "text",
                        "table" => "incidents",
                    ],
                    [
                        "label" => "Contact",
                        "name"  => "caller_contact",
                        "type"  => "phone",
                        "table" => "incidents",
                    ], 
                ],
            3 => 
                [
                    [
                        "label" => "Responder Team",
                        "name"  => "responder_team",
                        "type"  => "relation",
                        "table" => "incidents",
                    ], 
                    [
                        "label" => "Assigned By",
                        "name"  => "assigned_by",
                        "type"  => "text",
                        "table" => "incidents",
                    ],
                    [
                        "label" => "Assigned Team",
                        "name"  => "assigned_team",
                        "type"  => "text",
                        "table" => "incidents",
                    ],
                ],
            4 => 
                [
                    [
                        "label" => "Incident Resolution",
                        "name"  => "incident_resolution",
                        "type"  => "textarea",
                        "table" => "incidents",
                    ], 
                ],
            ],
            "resources" => [
                0 => [
                    [
                        "label" => "Resources Name",
                        "name"  => "resources_name",
                        "type"  => "text",
                        "table" => "resources",
                        "column" => 1
                    ], 
                    [
                        "label" => "Resource Category",
                        "name"  => "resources_categories",
                        "type"  => "dropdown",
                        "table" => "resources",
                    ], 
                    [
                        "label" => "Resource Type",
                        "name"  => "resources_types",
                        "type"  => "dropdown",
                        "table" => "resources",
                        "column" => 1
                    ], 
                    [
                        "label" => "Quantity",
                        "name"  => "quantity",
                        "type"  => "number",
                        "table" => "resources",
                        "default" => 1
                    ], 
                    [
                        "label" => "Resource Status",
                        "name"  => "resources_statuses",
                        "type"  => "dropdown",
                        "table" => "resources",
                    ], 
                    [
                        "label" => "Contact Info",
                        "name"  => "contact_info",
                        "type"  => "phone",
                        "table" => "resources",
                    ], 
                    [
                        "label" => "Owner",
                        "name"  => "owner",
                        "type"  => "text",
                        "table" => "resources",
                    ], 
                    [
                        "label" => "Date Acquired",
                        "name"  => "date_acquired",
                        "type"  => "date",
                        "table" => "resources",
                    ],
                    [
                        "label" => "Dispatch",
                        "name"  => "resources_dispatchers",
                        "type"  => "dropdown",
                        "table" => "resources",
                    ],
                    [
                        "label" => "Condition",
                        "name"  => "resources_conditions",
                        "type"  => "dropdown",
                        "table" => "resources",
                    ],
                    [
                        "label" => "Remarks",
                        "name"  => "remarks",
                        "type"  => "textarea",
                        "table" => "resources",
                    ],
                ],
                1 => [
                    [
                        "label" => "Coordinates",
                        "name"  => "coordinates",
                        "type"  => "coordinates",
                        "table" => "resources",
                        "readonly" => 1,
                        "required" => 1
                    ], 
                ],
            ],
            "preplans" => [
                0 => [
                    [
                        "label" => "Pre Plan Name",
                        "name"  => "preplan_name",
                        "type"  => "text",
                        "table" => "preplans",
                        "column" => 1
                    ], 
                    [
                        "label" => "Incident Type",
                        "name"  => "incident_types",
                        "type"  => "dropdown",
                        "table" => "preplans",
                    ], 
                    [
                        "label" => "Classification",
                        "name"  => "preplan_classifications",
                        "type"  => "dropdown",
                        "table" => "preplans",
                    ], 
                ],
                1 => [
                    [
                        "label" => "Initial Assessment",
                        "name"  => "initial_assessment",
                        "type"  => "textarea",
                        "table" => "preplans",
                    ], 
                    [
                        "label" => "Response Action",
                        "name"  => "response_action",
                        "type"  => "textarea",
                        "table" => "preplans",
                    ],
                    [
                        "label" => "Classification.",
                        "name"  => "classification",
                        "type"  => "textarea",
                        "table" => "preplans",
                    ],  
                ],
                2 => [
                    [
                        "label" => "Incident Manager",
                        "name"  => "incident_manager",
                        "type"  => "text",
                        "table" => "preplans",
                    ], 
                    [
                        "label" => "Incident Responder",
                        "name"  => "incident_responder",
                        "type"  => "text",
                        "table" => "preplans",
                    ],
                    [
                        "label" => "Support Staff",
                        "name"  => "support_staff",
                        "type"  => "text",
                        "table" => "preplans",
                    ],  
                ],
                3 => [
                    [
                        "label" => "Tools and Equipment",
                        "name"  => "tools_and_equipment",
                        "type"  => "textarea",
                        "table" => "preplans",
                    ], 
                    [
                        "label" => "Personnel",
                        "name"  => "personnel",
                        "type"  => "textarea",
                        "table" => "preplans",
                    ], 
                ],
            ],
            "contacts" => [
                0 => [
                    [
                        "label" => "First Name",
                        "name"  => "firstname",
                        "type"  => "text",
                        "table" => "contacts",
                        "column" => 1
                        
                    ], 
                    [
                        "label" => "Last Name",
                        "name"  => "lastname",
                        "type"  => "text",
                        "table" => "contacts",
                        "column" => 1
                    ], 
                    [
                        "label" => "Mobile No",
                        "name"  => "mobile",
                        "type"  => "phone",
                        "table" => "contacts",
                    ],
                    [
                        "label" => "Landline No",
                        "name"  => "landline",
                        "type"  => "text",
                        "table" => "contacts",
                    ],
                    [
                        "label" => "Primary Email",
                        "name"  => "primary_email",
                        "type"  => "email",
                        "table" => "contacts",
                    ], 
                    [
                        "label" => "Date of Birth",
                        "name"  => "date_of_birth",
                        "type"  => "date",
                        "table" => "contacts",
                    ], 
                    [
                        "label" => "Caller Type",
                        "name"  => "caller_types",
                        "type"  => "dropdown",
                        "table" => "contacts",
                    ], 
                ],
                1 => [
                    [
                        "label" => "Municipality",
                        "name"  => "municipalities",
                        "type"  => "text",
                        "table" => "contacts",
                    ], 
                    [
                        "label" => "Barangay",
                        "name"  => "barangays",
                        "type"  => "text",
                        "table" => "contacts",
                    ],
                    [
                        "label" => "Street Name",
                        "name"  => "street_name",
                        "type"  => "text",
                        "table" => "contacts",
                    ],  
                ],
            ],
            "agencies" => [
                0 => [
                    [
                        "label" => "Agency Name",
                        "name"  => "agency_name",
                        "type"  => "text",
                        "table" => "agencies",
                        "column" => 1
                    ], 
                    [
                        "label" => "Contact No. 1",
                        "name"  => "contact_no_1",
                        "type"  => "phone",
                        "table" => "agencies",
                    ], 
                    [
                        "label" => "Contact No. 2",
                        "name"  => "contact_no_2",
                        "type"  => "phone",
                        "table" => "agencies",
                    ], 
                    [
                        "label" => "Primary Email",
                        "name"  => "primary_email",
                        "type"  => "email",
                        "table" => "agencies",
                    ],
                ],
                1 => [
                    [
                        "label" => "Municipality",
                        "name"  => "municipalities",
                        "type"  => "text",
                        "table" => "agencies",
                    ], 
                    [
                        "label" => "Barangay",
                        "name"  => "barangays",
                        "type"  => "text",
                        "table" => "agencies",
                    ],
                    [
                        "label" => "Street Name",
                        "name"  => "street_name",
                        "type"  => "text",
                        "table" => "agencies",
                    ],  
                ],
            ],
            "responders" => [
                0 => [
                    [
                        "label" => "Responder Type",
                        "name"  => "responder_types",
                        "type"  => "dropdown",
                        "table" => "responders",
                        "column" => 1
                    ], 
                    [
                        "label" => "First Name",
                        "name"  => "firstname",
                        "type"  => "text",
                        "table" => "responders",
                        "column" => 1
                    ], 
                    [
                        "label" => "Last Name",
                        "name"  => "lastname",
                        "type"  => "text",
                        "table" => "responders",
                        "column" => 1
                    ], 
                    [
                        "label" => "Contact No",
                        "name"  => "contact_no",
                        "type"  => "phone",
                        "table" => "responders",
                    ],
                ],
                1 => [
                    [
                        "label" => "Email Address",
                        "name"  => "email_address",
                        "type"  => "email",
                        "table" => "responders",
                    ], 
                    [
                        "label" => "Password",
                        "name"  => "password",
                        "type"  => "text",
                        "table" => "responders",
                    ],
                    [
                        "label" => "Assigned To",
                        "name"  => "assigned_to",
                        "type"  => "text",
                        "table" => "responders",
                    ],  
                    [
                        "label" => "Status",
                        "name"  => "responder_statuses",
                        "type"  => "dropdown",
                        "table" => "responders",
                    ], 
                ],
            ],
            "call_logs" => [
                0 => [
                    [
                        "label" => "Date and Time",
                        "name"  => "date_and_time",
                        "type"  => "text",
                        "table" => "call_logs",
                        "column" => 1
                    ],
                    [
                        "label" => "Time Answered",
                        "name"  => "time_answered",
                        "type"  => "text",
                        "table" => "call_logs",
                        "column" => 1
                    ], 
                    [
                        "label" => "Time End",
                        "name"  => "time_end",
                        "type"  => "text",
                        "table" => "call_logs",
                        "column" => 1
                    ],
                    [
                        "label" => "Duration",
                        "name"  => "duration",
                        "type"  => "text",
                        "table" => "call_logs",
                        "column" => 1
                    ],
                    [
                        "label" => "From No",
                        "name"  => "from_no",
                        "type"  => "text",
                        "table" => "call_logs",
                    ],
                    [
                        "label" => "To No",
                        "name"  => "to_no",
                        "type"  => "text",
                        "table" => "call_logs",
                    ],
                    [
                        "label" => "Call ID",
                        "name"  => "call_id",
                        "type"  => "text",
                        "table" => "call_logs",
                    ], 
                ],
            ],
            "reports" => [
                0 => [
                    [
                        "label" => "Report Name",
                        "name"  => "report_name",
                        "type"  => "text",
                        "table" => "reports",
                        "column" => 1
                    ], 
                    [
                        "label" => "Module",
                        "name"  => "modules",
                        "type"  => "dropdown",
                        "table" => "reports",
                        "column" => 1
                    ], 
                    [
                        "label" => "Type",
                        "name"  => "type",
                        "type"  => "text",
                        "table" => "reports",
                        "column" => 1
                    ], 
                ],
            ],
            "users" => [
                0 => [
                    [
                        "label" => "Name",
                        "name"  => "name",
                        "type"  => "text",
                        "table" => "users",
                        "column" => 1,
                        "required" => 1
                    ], 
                    [
                        "label" => "Email",
                        "name"  => "email",
                        "type"  => "email",
                        "table" => "users",
                        "column" => 1,
                        "required" => 1
                    ], 
                    [
                        "label" => "Role",
                        "name"  => "user_roles",
                        "type"  => "dropdown",
                        "table" => "users",
                        "column" => 1,
                        "required" => 1
                    ],
                    [
                        "label" => "Password",
                        "name"  => "password",
                        "type"  => "text",
                        "table" => "users",
                        "required" => 1
                    ],
                ],
                1 => [
                    [
                        "label" => "Incident",
                        "name"  => "incidents",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ], 
                    [
                        "label" => "Resource",
                        "name"  => "resources",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ], 
                    [
                        "label" => "Pre Plan",
                        "name"  => "preplans",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ], 
                    [
                        "label" => "Contact",
                        "name"  => "contacts",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ],
                    [
                        "label" => "Agency",
                        "name"  => "agencies",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ],
                    [
                        "label" => "Responder",
                        "name"  => "responders",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ],
                    [
                        "label" => "Call Logs",
                        "name"  => "call_logs",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ],
                    // [
                    //     "label" => "User",
                    //     "name"  => "users",
                    //     "type"  => "checkbox",
                    //     "table" => "user_privileges",
                    // ],
                    [
                        "label" => "Report",
                        "name"  => "reports",
                        "type"  => "checkbox",
                        "table" => "user_privileges",
                        "default" => true
                    ],
                ],
            ],
            "media" => [
                0 => [ 
                    [
                        "label" => "File Title",
                        "name"  => "filetitle",
                        "type"  => "text",
                        "table" => "media",
                        "column" => 1
                    ],
                    [
                        "label" => "Assigned To",
                        "name"  => "assigned_to",
                        "type"  => "dropdown",
                        "table" => "media",
                        "column" => 1
                    ],
                    [
                        "label" => "Note",
                        "name"  => "note",
                        "type"  => "textarea",
                        "table" => "media",
                        "column" => 1
                    ],
                ],
                1 => [
                    [
                        "label" => "Filename",
                        "name"  => "filename",
                        "type"  => "text",
                        "table" => "media",
                        "column" => 1
                    ], 
                    [
                        "label" => "Extension",
                        "name"  => "extension",
                        "type"  => "text",
                        "table" => "media",
                    ], 
                    [
                        "label" => "Filetype",
                        "name"  => "filetype",
                        "type"  => "text",
                        "table" => "media",
                        "display_type" => 0
                    ],
                    [
                        "label" => "Path",
                        "name"  => "path",
                        "type"  => "text",
                        "table" => "media",
                        "display_type" => 0
                    ],
                ]
            ],
            "tasks" => [
                0 =>[
                    [
                        "label" => "Task Name",
                        "name"  => "name",
                        "type"  => "text",
                        "table" => "tasks",
                        "column" => 1
                    ],
                    [
                        "label" => "Status",
                        "name"  => "status",
                        "type"  => "dropdown",
                        "table" => "tasks",
                        "column" => 1
                    ],
                    [
                        "label" => "Description",
                        "name"  => "description",
                        "type"  => "textarea",
                        "table" => "tasks",
                        "column" => 1
                    ],
                ]
            ]
        ];
        $modules = Module::whereNot('name','comments')->get();
        foreach($modules as $module){
            foreach($blocks[$module->name] as $key => $block){
                $block_model = new Block();
                $block_model->module_id = $module->id;
                $block_model->block = $block;
                $block_model->sequence = 1;
                $block_model->save();

                foreach($fields[$module->name][$key] as $k =>$field){
                    $field_model = new Field();
                    $field_model->module_id = $module->id;
                    $field_model->block_id = $block_model->id;
                    $field_model->name = $field['name'];
                    $field_model->table = $field['table'];
                    $field_model->label = $field['label'];
                    $field_model->type = $field['type'];
                    $field_model->readonly = $field['readonly'] ?? 0;
                    $field_model->required = $field['required'] ?? 0;
                    $field_model->column = $field['column'] ?? 0;
                    $field_model->default_value = $field['default'] ?? null;
                    $field_model->display_type = $field['display_type'] ?? 1;
                    $field_model->sequence = 1;
                    $field_model->save();
                }
            }
        }
    }
}
