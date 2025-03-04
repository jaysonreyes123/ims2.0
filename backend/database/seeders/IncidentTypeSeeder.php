<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('incident_types')->insert(
            [
                array('label' => 'Medical Emergency'),
                array('label' => 'Motor Accident'),
                array('label' => 'Viber Report Message'),
                array('label' => 'Injury Incident'),
                array('label' => 'Vehicle Accident'),
                array('label' => 'Fire Emergency'),
                array('label' => 'Road Traffic Accidents'),
                array('label' => 'Physical Assaults'),
                array('label' => 'Fatal Accidents'),
                array('label' => 'Floods'),
                array('label' => 'Tropical Storms'),
                array('label' => 'Hurricanes Storms'),
                array('label' => 'Earthquakes'),
                array('label' => 'Wildfires'),
                array('label' => 'Bomb Threat'),
                array('label' => 'Hostage Situation'),
                array('label' => 'Severe Weather'),
                array('label' => 'Civil Disturbances'),
                array('label' => 'Car Accident'),
                array('label' => 'Hurricane'),
                array('label' => 'Landslide'),
                array('label' => 'Power Outage'),
                array('label' => 'Thunderstorm'),
                array('label' => 'Water Safety'),
                array('label' => 'Poisoning'),
                array('label' => 'Food Poison'),
                array('label' => 'Heart Attack'),
                array('label' => 'Pool Drown'),
                array('label' => 'Swimming Pool Accident'),
                array('label' => 'Suspicious Activity'),
                array('label' => 'Theft'),
                array('label' => 'Abuse'),
                array('label' => 'Harassment'),
                array('label' => 'Car Crash'),
                array('label' => 'Motor Crash'),
                array('label' => 'Fire Burn'),
                array('label' => 'Skin Burn'),
                array('label' => 'Motor Theft'),
                array('label' => 'Car Theft'),
                array('label' => 'Security Incident'),
                array('label' => 'Property Damage'),
                array('label' => 'Death/Serious Incident'),
                array('label' => 'Drowning'),
                array('label' => 'High Blood'),
                array('label' => 'River Overflow'),
                array('label' => 'River Drowning'),
                array('label' => 'Road Flood'),
                array('label' => 'Road Landslide'),
                array('label' => 'Cardiac Arrest'),
                array('label' => 'Covid Report'),
                array('label' => 'Road Closed'),
                array('label' => 'Truck Accident'),
                array('label' => 'Motorcycle Accident'),
                array('label' => 'Bike Accident'),
                array('label' => 'Private Property Tresspassing'),
                array('label' => 'Tresspassing'),
                array('label' => 'Noise Complaint'),
                array('label' => 'Car Fire Accident'),
                array('label' => 'Overspeeding'),
                array('label' => 'Traffic Accident'),
                array('label' => 'Death Threat'),
                array('label' => 'School Accident'),
                array('label' => 'School Fire Accident'),
                array('label' => 'Residential Disturbance'),
                array('label' => 'Disturbance'),
                array('label' => 'Chaos'),
                array('label' => 'Damage Property'),
                array('label' => 'Bomb Accident'),
                array('label' => 'Bullying'),
                array('label' => 'School Bullying'),
                array('label' => 'Child Abuse'),
                array('label' => 'Rape'),
                array('label' => 'Virus Report'),
                array('label' => 'Medical Assistant Report'),
                array('label' => 'Inquiry'),
                array('label' => 'Need Rescue'),
                array('label' => 'Rescue Assistance'),
                array('label' => 'Need Ambulance'),
                array('label' => 'Forest Fire'),
                array('label' => 'Residential Fire'),
                array('label' => 'School Fire'),
                array('label' => 'Lost Person'),
                array('label' => 'Road Traffic Accident'),
                array('label' => 'Clinical Negligence'),
                array('label' => 'Sports Related Injuries'),
                array('label' => 'Animal Accident'),
                array('label' => 'Animal Bites'),
                array('label' => 'Sexual Harassment'),
                array('label' => 'Assault'),
                array('label' => 'Hate Crimes'),
                array('label' => 'Hazing'),
                array('label' => 'Domestic Violence'),
                array('label' => 'Discrimination'),
                array('label' => 'Fraud'),
                array('label' => 'Concerns'),
                array('label' => 'Vandalism'),
                array('label' => 'Unauthorized Access'),
                array('label' => 'Suicide Risks'),
                array('label' => 'Weapons'),
                array('label' => 'Illegal Gambling'),
                array('label' => 'Exploitation'),
                array('label' => 'Intruder'),
                array('label' => 'Collisions'),
                array('label' => 'Stalking'),
                array('label' => 'Catcalling'),
                array('label' => 'Street Harassment'),
                array('label' => 'Identity Theft'),
                array('label' => 'Terrorism'),
                array('label' => 'Wanted Person Report'),
                array('label' => 'Illegal Firearms'),
                array('label' => 'Illegal Sabong'),
                array('label' => 'Illegal Drugs'),
                array('label' => 'Illegal Weapons'),
                array('label' => 'Email Report'),
                array('label' => 'Traffic Light Violator'),
                array('label' => 'Pedestrian Accident'),
                array('label' => 'Beating The Red Light'),
                array('label' => 'Power Plant Accident'),
                array('label' => 'Road Crash'),
                array('label' => 'Bus Accident'),
                array('label' => 'Bus Collision'),
                array('label' => 'Bridge Accident'),
                array('label' => 'Illegal Bike Races'),
                array('label' => 'Freak Accident'),
                array('label' => 'Illegal Race'),
                array('label' => 'Highway Accident'),
                array('label' => 'Plane Accident'),
                array('label' => 'Shipyard Accident'),
                array('label' => 'Port Accident'),
                array('label' => 'Smuggled Vehicle'),
                array('label' => 'Fatal Accident'),
                array('label' => 'Ambushed'),
                array('label' => 'Cargo Truck Accident'),
                array('label' => 'Shuttle Bus Accident'),
                array('label' => 'Shooting Accident'),
                array('label' => 'Trauma'),
                array('label' => 'OB-Gyne'),
                array('label' => 'Others'),
                array('label' => 'Robbery'),
                array('label' => 'Physical Abuse'),
                array('label' => 'Trap Elevator'),
                array('label' => 'Trap Inside the Car'),
                array('label' => 'Fire'),
                array('label' => 'Flood'),
                array('label' => 'Accident'),
                array('label' => 'Medical')
            ]
        );
    }
}
