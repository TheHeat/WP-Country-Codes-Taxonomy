<?php
/*
Plugin Name: WP Country Codes Taxonomy
Plugin URI: 
Description: Adds a taxonomy countries and pre-populates it using country codes as slugs
Version: 1.0
Author: Marc Heatley
Author URI: http://marcheatleydesign.com
License: GPLv2 or later
Notes:  Based on WP Theme Tutorial by Curis McHale https://github.com/curtismchale/WP-Theme-Tutorial---US-States-Plugin-for-WordPress.
        Country code dataset thanks to https://github.com/lukes/ISO-3166-Countries-with-Regional-Codes
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Register the "Country" taxonomy

function wp_cc_tax_custom_taxonomy() {

  // Define labels in an array

  $labels = array(
    'name'                => _x( 'Country', 'taxonomy general name' ),
    'singular_name'       => _x( 'Countries', 'taxonomy singular name' ),
    'search_items'        =>  __( 'Search Countries' ),
    'all_items'           => __( 'All Countries' ),
    'edit_item'           => __( 'Edit Country' ),
    'update_item'         => __( 'Update Country' ),
    'add_new_item'        => __( 'Add New Country' ),
    'new_item_name'       => __( 'New Country Name' ),
    'menu_name'           => __( 'Countries' ),
  );

  register_taxonomy( 'wp_cc_tax_country', array( 'post' ), array(
    'hierarchical'=> true,
    'labels'      => $labels,
    'show_ui'     => true,
    'query_var'   => true,
    'rewrite'     => array( 'slug'   => 'state' ),
  ));
}

add_action( 'init', 'wp_cc_tax_custom_taxonomy');

// Set default terms for the custom taxonomies

function wp_cc_tax_default_terms(){

	// Check if terms are populated
    $country = get_terms( 'wp_cc_tax_country', array( 'hide_empty'=> false ) );

    // if no terms then lets add our terms
    if( empty( $country ) ){
        $countries = wp_cc_tax_get_countries();
        foreach( $countries as $country ){
            // belt & braces - check whether this specific term exists
            if( !term_exists( $country['name'], 'wp_cc_tax_country' ) ){
                wp_insert_term( $country['name'], 'wp_cc_tax_country', array( 'slug'  => $country['code'] ) );
            }
        }
    }

}
add_action( 'init', 'wp_cc_tax_default_terms' );


/**
 * Returns an array of countries with name and proper short form
 *
 * @return 	array
 *
 * @since   1.0
 * @author 	WP Theme Tutorial, Curtis McHale
 */
function wp_cc_tax_get_countries(){

    $countries = array(
        "0"   => array( "name" => "Afghanistan" , "code" => "AF"),
        "1"   => array( "name" => "Åland Islands" , "code"     => "AX"),
        "2"   => array( "name" => "Albania" , "code" => "AL"),
        "3"   => array( "name" => "Algeria" , "code" => "DZ"),
        "4"   => array( "name" => "American Samoa" , "code" => "AS"),
        "5"   => array( "name" => "Andorra" , "code" => "AD"),
        "6"   => array( "name" => "Angola" , "code" => "AO"),
        "7"   => array( "name" => "Anguilla" , "code" => "AI"),
        "8"   => array( "name" => "Antarctica" , "code" => "AQ"),
        "9"   => array( "name" => "Antigua and Barbuda" , "code" => "AG"),
        "10"  => array( "name" => "Argentina" , "code"    => "AR"),
        "11"  => array( "name" => "Armenia" , "code" => "AM"),
        "12"  => array( "name" => "Aruba" , "code"    => "AW"),
        "13"  => array( "name" => "Australia" , "code"    => "AU"),
        "14"  => array( "name" => "Austria" , "code" => "AT"),
        "15"  => array( "name" => "Azerbaijan" , "code"  => "AZ"),
        "16"  => array( "name" => "Bahamas" , "code" => "BS"),
        "17"  => array( "name" => "Bahrain" , "code" => "BH"),
        "18"  => array( "name" => "Bangladesh" , "code"  => "BD"),
        "19"  => array( "name" => "Barbados" , "code"      => "BB"),
        "20"  => array( "name" => "Belarus" , "code" => "BY"),
        "21"  => array( "name" => "Belgium" , "code" => "BE"),
        "22"  => array( "name" => "Belize" , "code"  => "BZ"),
        "23"  => array( "name" => "Benin" , "code"    => "BJ"),
        "24"  => array( "name" => "Bermuda" , "code" => "BM"),
        "25"  => array( "name" => "Bhutan" , "code"  => "BT"),
        "26"  => array( "name" => "Bolivia, Plurinational State of" , "code" => "BO"),
        "27"  => array( "name" => "Bonaire, Sint Eustatius and Saba" , "code"      => "BQ"),
        "28"  => array( "name" => "Bosnia and Herzegovina" , "code"  => "BA"),
        "29"  => array( "name" => "Botswana" , "code"      => "BW"),
        "30"  => array( "name" => "Bouvet Island" , "code"    => "BV"),
        "31"  => array( "name" => "Brazil" , "code"  => "BR"),
        "32"  => array( "name" => "British Indian Ocean Territory" , "code"  => "IO"),
        "33"  => array( "name" => "Brunei Darussalam" , "code"    => "BN"),
        "34"  => array( "name" => "Bulgaria" , "code"      => "BG"),
        "35"  => array( "name" => "Burkina Faso" , "code"      => "BF"),
        "36"  => array( "name" => "Burundi" , "code" => "BI"),
        "37"  => array( "name" => "Cambodia" , "code"      => "KH"),
        "38"  => array( "name" => "Cameroon" , "code"      => "CM"),
        "39"  => array( "name" => "Canada" , "code"  => "CA"),
        "40"  => array( "name" => "Cape Verde" , "code"  => "CV"),
        "41"  => array( "name" => "Cayman Islands" , "code"  => "KY"),
        "42"  => array( "name" => "Central African Republic" , "code"      => "CF"),
        "43"  => array( "name" => "Chad" , "code" => "TD"),
        "44"  => array( "name" => "Chile" , "code" => "CL"),
        "45"  => array( "name" => "China" , "code" => "CN"),
        "46"  => array( "name" => "Christmas Island" , "code" => "CX"),
        "47"  => array( "name" => "Cocos (Keeling) Islands" , "code" => "CC"),
        "48"  => array( "name" => "Colombia" , "code" => "CO"),
        "49"  => array( "name" => "Comoros" , "code" => "KM"),
        "50"  => array( "name" => "Congo" , "code" => "CG"),
        "51"  => array( "name" => "Congo, the Democratic Republic of the" , "code"    => "CD"),
        "52"  => array( "name" => "Cook Islands" , "code" => "CK"),
        "53"  => array( "name" => "Costa Rica" , "code" => "CR"),
        "54"  => array( "name" => "Côte d'Ivoire" , "code"    => "CI"),
        "55"  => array( "name" => "Croatia" , "code" => "HR"),
        "56"  => array( "name" => "Cuba" , "code" => "CU"),
        "57"  => array( "name" => "Curaçao" , "code" => "CW"),
        "58"  => array( "name" => "Cyprus" , "code" => "CY"),
        "59"  => array( "name" => "Czech Republic" , "code"  => "CZ"),
        "60"  => array( "name" => "Denmark" , "code" => "DK"),
        "61"  => array( "name" => "Djibouti" , "code" => "DJ"),
        "62"  => array( "name" => "Dominica" , "code" => "DM"),
        "63"  => array( "name" => "Dominican Republic" , "code"  => "DO"),
        "64"  => array( "name" => "Ecuador" , "code" => "EC"),
        "65"  => array( "name" => "Egypt" , "code" => "EG"),
        "66"  => array( "name" => "El Salvador" , "code" => "SV"),
        "67"  => array( "name" => "Equatorial Guinea" , "code"    => "GQ"),
        "68"  => array( "name" => "Eritrea" , "code" => "ER"),
        "69"  => array( "name" => "Estonia" , "code" => "EE"),
        "70"  => array( "name" => "Ethiopia" , "code" => "ET"),
        "71"  => array( "name" => "Falkland Islands (Malvinas)" , "code" => "FK"),
        "72"  => array( "name" => "Faroe Islands" , "code" => "FO"),
        "73"  => array( "name" => "Fiji" , "code" => "FJ"),
        "74"  => array( "name" => "Finland" , "code" => "FI"),
        "75"  => array( "name" => "France" , "code" => "FR"),
        "76"  => array( "name" => "French Guiana" , "code"    => "GF"),
        "77"  => array( "name" => "French Polynesia" , "code"      => "PF"),
        "78"  => array( "name" => "French Southern Territories" , "code" => "TF"),
        "79"  => array( "name" => "Gabon" , "code" => "GA"),
        "80"  => array( "name" => "Gambia" , "code"  => "GM"),
        "81"  => array( "name" => "Georgia" , "code" => "GE"),
        "82"  => array( "name" => "Germany" , "code" => "DE"),
        "83"  => array( "name" => "Ghana" , "code" => "GH"),
        "84"  => array( "name" => "Gibraltar" , "code" => "GI"),
        "85"  => array( "name" => "Greece" , "code" => "GR"),
        "86"  => array( "name" => "Greenland" , "code" => "GL"),
        "87"  => array( "name" => "Grenada" , "code" => "GD"),
        "88"  => array( "name" => "Guadeloupe" , "code" => "GP"),
        "89"  => array( "name" => "Guam" , "code" => "GU"),
        "90"  => array( "name" => "Guatemala" , "code" => "GT"),
        "91"  => array( "name" => "Guernsey" , "code" => "GG"),
        "92"  => array( "name" => "Guinea" , "code" => "GN"),
        "93"  => array( "name" => "Guinea-Bissau" , "code"    => "GW"),
        "94"  => array( "name" => "Guyana" , "code" => "GY"),
        "95"  => array( "name" => "Haiti" , "code" => "HT"),
        "96"  => array( "name" => "Heard Island and McDonald Islands" , "code" => "HM"),
        "97"  => array( "name" => "Holy See (Vatican City State)" , "code" => "VA"),
        "98"  => array( "name" => "Honduras" , "code" => "HN"),
        "99"  => array( "name" => "Hong Kong" , "code" => "HK"),
        "100" => array( "name" => "Hungary" , "code" => "HU"),
        "101" => array( "name" => "Iceland" , "code" => "IS"),
        "102" => array( "name" => "India" , "code" => "IN"),
        "103" => array( "name" => "Indonesia" , "code" => "ID"),
        "104" => array( "name" => "Iran, Islamic Republic of" , "code" => "IR"),
        "105" => array( "name" => "Iraq" , "code" => "IQ"),
        "106" => array( "name" => "Ireland" , "code" => "IE"),
        "107" => array( "name" => "Isle of Man" , "code" => "IM"),
        "108" => array( "name" => "Israel" , "code" => "IL"),
        "109" => array( "name" => "Italy" , "code" => "IT"),
        "110" => array( "name" => "Jamaica" , "code" => "JM"),
        "111" => array( "name" => "Japan" , "code" => "JP"),
        "112" => array( "name" => "Jersey" , "code" => "JE"),
        "113" => array( "name" => "Jordan" , "code" => "JO"),
        "114" => array( "name" => "Kazakhstan" , "code" => "KZ"),
        "115" => array( "name" => "Kenya" , "code" => "KE"),
        "116" => array( "name" => "Kiribati" , "code" => "KI"),
        "117" => array( "name" => "Korea, Democratic People's Republic of" , "code"  => "KP"),
        "118" => array( "name" => "Korea, Republic of" , "code" => "KR"),
        "119" => array( "name" => "Kuwait" , "code" => "KW"),
        "120" => array( "name" => "Kyrgyzstan" , "code" => "KG"),
        "121" => array( "name" => "Lao People's Democratic Republic" , "code"     => "LA"),
        "122" => array( "name" => "Latvia" , "code" => "LV"),
        "123" => array( "name" => "Lebanon" , "code" => "LB"),
        "124" => array( "name" => "Lesotho" , "code" => "LS"),
        "125" => array( "name" => "Liberia" , "code" => "LR"),
        "126" => array( "name" => "Libya" , "code" => "LY"),
        "127" => array( "name" => "Liechtenstein" , "code" => "LI"),
        "128" => array( "name" => "Lithuania" , "code" => "LT"),
        "129" => array( "name" => "Luxembourg" , "code"  => "LU"),
        "130" => array( "name" => "Macao" , "code" => "MO"),
        "131" => array( "name" => "Macedonia, the former Yugoslav Republic of" , "code"  => "MK"),
        "132" => array( "name" => "Madagascar" , "code" => "MG"),
        "133" => array( "name" => "Malawi" , "code"  => "MW"),
        "134" => array( "name" => "Malaysia" , "code" => "MY"),
        "135" => array( "name" => "Maldives" , "code" => "MV"),
        "136" => array( "name" => "Mali" , "code" => "ML"),
        "137" => array( "name" => "Malta" , "code" => "MT"),
        "138" => array( "name" => "Marshall Islands" , "code"     => "MH"),
        "139" => array( "name" => "Martinique" , "code" => "MQ"),
        "140" => array( "name" => "Mauritania" , "code" => "MR"),
        "141" => array( "name" => "Mauritius" , "code" => "MU"),
        "142" => array( "name" => "Mayotte" , "code" => "YT"),
        "143" => array( "name" => "Mexico" , "code" => "MX"),
        "144" => array( "name" => "Micronesia, Federated States of" , "code" => "FM"),
        "145" => array( "name" => "Moldova, Republic of" , "code"     => "MD"),
        "146" => array( "name" => "Monaco" , "code" => "MC"),
        "147" => array( "name" => "Mongolia" , "code" => "MN"),
        "148" => array( "name" => "Montenegro" , "code" => "ME"),
        "149" => array( "name" => "Montserrat" , "code" => "MS"),
        "150" => array( "name" => "Morocco" , "code" => "MA"),
        "151" => array( "name" => "Mozambique" , "code" => "MZ"),
        "152" => array( "name" => "Myanmar" , "code" => "MM"),
        "153" => array( "name" => "Namibia" , "code" => "NA"),
        "154" => array( "name" => "Nauru" , "code" => "NR"),
        "155" => array( "name" => "Nepal" , "code" => "NP"),
        "156" => array( "name" => "Netherlands" , "code" => "NL"),
        "157" => array( "name" => "New Caledonia" , "code" => "NC"),
        "158" => array( "name" => "New Zealand" , "code" => "NZ"),
        "159" => array( "name" => "Nicaragua" , "code" => "NI"),
        "160" => array( "name" => "Niger" , "code" => "NE"),
        "161" => array( "name" => "Nigeria" , "code" => "NG"),
        "162" => array( "name" => "Niue" , "code" => "NU"),
        "163" => array( "name" => "Norfolk Island" , "code"  => "NF"),
        "164" => array( "name" => "Northern Mariana Islands" , "code"     => "MP"),
        "165" => array( "name" => "Norway" , "code" => "NO"),
        "166" => array( "name" => "Oman" , "code" => "OM"),
        "167" => array( "name" => "Pakistan" , "code"     => "PK"),
        "168" => array( "name" => "Palau" , "code" => "PW"),
        "169" => array( "name" => "Palestinian Territory, Occupied" , "code" => "PS"),
        "170" => array( "name" => "Panama" , "code"  => "PA"),
        "171" => array( "name" => "Papua New Guinea" , "code"     => "PG"),
        "172" => array( "name" => "Paraguay" , "code" => "PY"),
        "173" => array( "name" => "Peru" , "code" => "PE"),
        "174" => array( "name" => "Philippines" , "code" => "PH"),
        "175" => array( "name" => "Pitcairn" , "code" => "PN"),
        "176" => array( "name" => "Poland" , "code" => "PL"),
        "177" => array( "name" => "Portugal" , "code" => "PT"),
        "178" => array( "name" => "Puerto Rico" , "code" => "PR"),
        "179" => array( "name" => "Qatar" , "code" => "QA"),
        "180" => array( "name" => "Réunion" , "code" => "RE"),
        "181" => array( "name" => "Romania" , "code" => "RO"),
        "182" => array( "name" => "Russian Federation" , "code"  => "RU"),
        "183" => array( "name" => "Rwanda" , "code"  => "RW"),
        "184" => array( "name" => "Saint Barthélemy" , "code"     => "BL"),
        "185" => array( "name" => "Saint Helena, Ascension and Tristan da Cunha" , "code"     => "SH"),
        "186" => array( "name" => "Saint Kitts and Nevis" , "code" => "KN"),
        "187" => array( "name" => "Saint Lucia" , "code" => "LC"),
        "188" => array( "name" => "Saint Martin (French part)" , "code"  => "MF"),
        "189" => array( "name" => "Saint Pierre and Miquelon" , "code" => "PM"),
        "190" => array( "name" => "Saint Vincent and the Grenadines" , "code"     => "VC"),
        "191" => array( "name" => "Samoa" , "code" => "WS"),
        "192" => array( "name" => "San Marino" , "code"  => "SM"),
        "193" => array( "name" => "Sao Tome and Principe" , "code" => "ST"),
        "194" => array( "name" => "Saudi Arabia" , "code"     => "SA"),
        "195" => array( "name" => "Senegal" , "code" => "SN"),
        "196" => array( "name" => "Serbia" , "code"  => "RS"),
        "197" => array( "name" => "Seychelles" , "code"  => "SC"),
        "198" => array( "name" => "Sierra Leone" , "code"     => "SL"),
        "199" => array( "name" => "Singapore" , "code" => "SG"),
        "200" => array( "name" => "Sint Maarten (Dutch part)" , "code" => "SX"),
        "201" => array( "name" => "Slovakia" , "code"     => "SK"),
        "202" => array( "name" => "Slovenia" , "code"     => "SI"),
        "203" => array( "name" => "Solomon Islands" , "code" => "SB"),
        "204" => array( "name" => "Somalia" , "code" => "SO"),
        "205" => array( "name" => "South Africa" , "code"     => "ZA"),
        "206" => array( "name" => "South Georgia and the South Sandwich Islands" , "code"     => "GS"),
        "207" => array( "name" => "South Sudan" , "code" => "SS"),
        "208" => array( "name" => "Spain" , "code" => "ES"),
        "209" => array( "name" => "Sri Lanka" , "code" => "LK"),
        "210" => array( "name" => "Sudan" , "code" => "SD"),
        "211" => array( "name" => "Suriname" , "code" => "SR"),
        "212" => array( "name" => "Svalbard and Jan Mayen" , "code"  => "SJ"),
        "213" => array( "name" => "Swaziland" , "code" => "SZ"),
        "214" => array( "name" => "Sweden" , "code"  => "SE"),
        "215" => array( "name" => "Switzerland" , "code" => "CH"),
        "216" => array( "name" => "Syrian Arab Republic" , "code"     => "SY"),
        "217" => array( "name" => "Taiwan, Province of China" , "code" => "TW"),
        "218" => array( "name" => "Tajikistan" , "code"  => "TJ"),
        "219" => array( "name" => "Tanzania, United Republic of" , "code"     => "TZ"),
        "220" => array( "name" => "Thailand" , "code"     => "TH"),
        "221" => array( "name" => "Timor-Leste" , "code" => "TL"),
        "222" => array( "name" => "Togo" , "code"     => "TG"),
        "223" => array( "name" => "Tokelau" , "code" => "TK"),
        "224" => array( "name" => "Tonga" , "code" => "TO"),
        "225" => array( "name" => "Trinidad and Tobago" , "code" => "TT"),
        "226" => array( "name" => "Tunisia" , "code" => "TN"),
        "227" => array( "name" => "Turkey" , "code"  => "TR"),
        "228" => array( "name" => "Turkmenistan" , "code"     => "TM"),
        "229" => array( "name" => "Turks and Caicos Islands" , "code"     => "TC"),
        "230" => array( "name" => "Tuvalu" , "code"  => "TV"),
        "231" => array( "name" => "Uganda" , "code"  => "UG"),
        "232" => array( "name" => "Ukraine" , "code" => "UA"),
        "233" => array( "name" => "United Arab Emirates" , "code"     => "AE"),
        "234" => array( "name" => "United Kingdom" , "code"  => "GB"),
        "235" => array( "name" => "United States" , "code" => "US"),
        "236" => array( "name" => "United States Minor Outlying Islands" , "code"     => "UM"),
        "237" => array( "name" => "Uruguay" , "code" => "UY"),
        "238" => array( "name" => "Uzbekistan" , "code"  => "UZ"),
        "239" => array( "name" => "Vanuatu" , "code" => "VU"),
        "240" => array( "name" => "Venezuela, Bolivarian Republic of" , "code" => "VE"),
        "241" => array( "name" => "Viet Nam" , "code"     => "VN"),
        "242" => array( "name" => "Virgin Islands, British" , "code" => "VG"),
        "243" => array( "name" => "Virgin Islands, U.S." , "code"     => "VI"),
        "244" => array( "name" => "Wallis and Futuna" , "code" => "WF"),
        "245" => array( "name" => "Western Sahara" , "code"  => "EH"),
        "246" => array( "name" => "Yemen" , "code" => "YE"),
        "247" => array( "name" => "Zambia" , "code" => "ZM"),
        "248" => array( "name" => "Zimbabwe" , "code" => "ZW")
    );

    return $countries;
}
