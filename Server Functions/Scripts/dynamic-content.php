<?php 
$path = '/Projects/TheFacebook/Git/thefacebook/Server Functions/';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/data-handle.php';
require_once $_SERVER['DOCUMENT_ROOT'] . $path . 'Scripts/files.php';
class DynamicContent {
    private $dh;
    private $files;
    public function __construct() {
        $this->dh = new DataHandle();
        $this->files = new FileHandle();
    }

    public function DisplayUpdateProfileValues($i, $cookie_array, $attributes_update_displays) {
        $current_attribute = strtolower(str_replace(' ', '-', $this->dh->DisplayUpdateAccountAttributes[$i]));
        $id = $current_attribute . '-input';
        $gender_index = ($cookie_array[$i] == 'Male') ? 1 : 0;
        $interested_in_index = ($cookie_array[$i] == 'Men') ? 1 : 0;
        $input_type = '<input type="text" id="' . $id . '" name="' . $current_attribute . '" style="width:120px!important" value="' . $cookie_array[$i] . '">';

        switch ($i) {
            case 0:
            case 1:
            case 2:
            case 3:
                $input_type = substr($input_type, 0, strlen($input_type) - 1) . ' required>';
                break;
            case 5:
                $input_type = '<input type="date" id="birthday-input" name="birthday">';
                break;
            case 6:
                $gender_selection = (($gender_index == 0) ? "selected" : "");
                $input_type = '
                    <select id="' . $id . '" name="' . $current_attribute . '">                                                            
                        <option value="Male"' . $gender_selection . '>Male</option>
                        <option value="Female" ' . $gender_selection . '>Female</option>
                    </select>
                ';
                break;
            case 10:
                $education_status_values = $this->dh->education_status_choices;
                $input_type = '<select id="' . $id . '" name="' . $current_attribute . '">';

                for ($j = 0; $j < count($education_status_values); ++$j) {
                    $display = $education_status_values;
                    if ($cookie_array[$i] == $education_status_values[$j]) {
                        $input_type .= '<option value="' . ucwords($education_status_values[$j], '-') . '" selected>' . $display[$j] . '</option>';
                    } else {
                        $input_type .= '<option value="' . ucwords($education_status_values[$j], '-') . '">' . $display[$j] . '</option>';
                    }
                }
                $input_type .= '</select>';
                break;
            case 12:
                $looking_for_values = $this->dh->looking_for_choices;
                $input_type = '<select id="' . $id . '" name="' . $current_attribute . '">';
                
                for ($j = 0; $j < count($looking_for_values); ++$j) {
                    $display = $looking_for_values;
                    if ($cookie_array[$i] == $looking_for_values[$j]) {
                        $input_type .= '<option value="' . ucwords($looking_for_values[$j]) . '" selected>' . $display[$j] . '</option>';
                    } else {
                        $input_type .= '<option value="' . ucwords($looking_for_values[$j]) . '">' . $display[$j] . '</option>';
                    }
                }
                $input_type .= '</select>';
                break;
            case 13:
                $interested_in_selection = (($interested_in_index == 0) ? 'selected' : "");
                $input_type = '
                    <select id="' . $id . '" name="' . $current_attribute . '">                                                            
                        <option value="Men"' . $interested_in_selection . '>Men</option>
                        <option value="Women" ' . $interested_in_selection . '>Women</option>
                    </select>
                ';
                break;
            case 16:
            case 17:
            case 18:
            case 19:
                $input_type = '<textarea id="' . $id . '" name="' . $current_attribute . '" class="update-profile">' . $cookie_array[$i] . '</textarea>';
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
    public function DisplayCachedDefaultProfileImage() {
        echo '<img src="' . PageData::ROOT . 'Server Functions/get-cached-image.php?def=1&def-index=0">';
    }
    public function DisplayCachedProfileImage($identifier, $extension) {
        echo '<img src="' . PageData::ROOT . 'Server Functions/get-cached-image.php?profile=1&id=' . $identifier . '&extension=' . $extension . '">';
    }
}
?>