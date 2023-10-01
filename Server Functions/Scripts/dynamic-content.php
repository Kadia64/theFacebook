<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
class DynamicContent {
    private $dh;
    public function __construct() {
        $this->dh = new DataHandle();
    }

    public function DisplayUpdateProfileValues($i, $cookie_array, $attributes_update_displays) {
        $current_attribute = strtolower(str_replace(' ', '-', $this->dh->DisplayUpdateAccountAttributes[$i]));
        $id = $current_attribute . '-input';
        $gender_index = ($cookie_array[$i] == 'male') ? 1 : 0;
        $input_type = '<input type="text" id="' . $id . '" name="' . $current_attribute . '" style="width:120px!important" value="' . $cookie_array[$i] . '">';

        switch ($i) {
            case 5:
                $input_type = '<input type="date" id="birthday-input" name="birthday">';
                break;
            case 6:
                $gender_selection = (($gender_index == 0) ? "selected" : "");
                $input_type = '
                    <select id="' . $id . '" name="' . $current_attribute . '">                                                            
                        <option value="male"' . $gender_selection . '>Male</option>
                        <option value="female" ' . $gender_selection . '>Female</option>
                    </select>
                ';
                break;
            case 10:
                $education_status_values = $this->dh->education_status_choices;
                $input_type = '<select id="' . $id . '" name="' . $current_attribute . '">';

                for ($j = 0; $j < count($education_status_values); ++$j) {
                    $display = $education_status_values;
                    $education_status_values[$j] = $education_status_values[$j];
                    if ($cookie_array[$i] == $education_status_values[$j]) {
                        $input_type .= '<option value="' . ucwords($education_status_values[$j], '-') . '" selected>' . $display[$j] . '</option>';
                    } else {
                        $input_type .= '<option value="' . ucwords($education_status_values[$j], '-') . '">' . $display[$j] . '</option>';
                    }
                }
                $input_type .= '</select>';
                break;
        }
        
        echo '
            <div>
                <p>' . $attributes_update_displays[$i] . '</p>
            </div>
            <div class="profile-update-input">
                ' . $input_type . '
            </div>
        ';
    }
}
?>