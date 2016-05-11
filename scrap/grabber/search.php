<?php
//=====================================================================
//=  !!! This script only works on a webserver with PHP support !!!   =
//=====================================================================
//=                                                                   =
//=          Copyright 2008 Jadetools Ltd. (www.jadetools.com)        =
//=                                                                   =
//=====================================================================

session_start();


// Include the search data
require "search/properties_data.php";

require "search/utils.php";

// Create search page object
$searchpage = new Tsearch;

class Tsearch
{

  var $do_sort          = false;
  var $show_results     = false;
  var $new_search       = false;
  var $sort_type;
  var $properties_found = 0;


  //-----------------------------------------------
  // Search constructor
  //-----------------------------------------------
  function Tsearch()
  {
    require "search/templates.php";

    // Start clocking page load time
    $time_start = microtime_float();

    // Check what page to serve
    if (array_key_exists('btn_search', $_GET))
    {
      $this->show_results = true;

      // Use eval instead of echo to allow user defined php code in the templates.
      eval('?>' . $this->get_HTML_search_page_results());
    }
    elseif (array_key_exists('btn_clear', $_GET))
    {
      $this->new_search   = true;

      // Use eval instead of echo to allow user defined php code in the templates.
      eval('?>' . $this->get_HTML_search_page());
    }
    else
    {
      // Use eval instead of echo to allow user defined php code in the templates.
      eval('?>' . $this->get_HTML_search_page());
    }

    // Calculate page load time
    $time_end = microtime_float();
    $time = $time_end - $time_start;

    // Print page load time
//    echo "Page loaded in $time seconds\n";

  }


  //-------------------------------------------------------------------
  // Read input data
  //-------------------------------------------------------------------
  function extract_search_get_data()
  {
    global $search_items, $start;

    // Read start value
    if (array_key_exists('start', $_GET) && (! empty($_GET['start'])))
    {
      $start = $_GET['start'];

      if (($start < 1) || (! is_numeric($start)))
      {
        $start = 1;
      }
    }
    else
    {
      $start = 1;
    }


    // Read search item values from GET variables
    foreach ($search_items as $search_item)
    {
      $search_name = $search_item['name'];

      if (array_key_exists($search_name, $_GET) && (! empty($_GET[$search_name])))
      {
        $search_items[$search_name]['value'] = $_GET[$search_name];
      }
    }

    // Save search items in session
    // Only save if search button has been clicked.
    if ($this->show_results)
    {
      $_SESSION['session_search_items'] = $search_items;
    }
    elseif ($this->new_search)
    {
      unset($_SESSION['session_search_items']);
    }

  }


  //-------------------------------------------------------------------
  // Build new URL GET part from current search items
  //-------------------------------------------------------------------
  function get_navigation_URL($astart)
  {
    global $search_items, $jdata;

    $arguments = '';

    // Add search settings
    foreach ($search_items as $search_item)
    {
      if ($arguments != '')
      {
        $arguments .= '&amp;';
      }


      $arguments .= $search_item['name'] . '=' . $search_item['value'];
    }


    // Add sorting argument
    if ($this->do_sort)
    {
      if ($arguments != '')
      {
        $arguments .= '&amp;';
      }

      $arguments .= 'sort' . '=' . $jdata->sort_column;

      if ($jdata->sort_reversed)
      {
        $arguments .= '-reversed';
      }
    }

    $url = 'search.php?btn_search=Search&amp;' . $arguments . '&amp;start=' . $astart;

    return $url;

  }


  //-------------------------------------------------------------------
  // Extract sort data from HTTP GET info
  //-------------------------------------------------------------------
  function extract_sort_get_data()
  {
    global $jdata, $search_items;

    if (array_key_exists('sort', $_GET) && (! empty($_GET['sort'])))
    {
      $sort_id = $_GET['sort'];

      $pos = strpos($sort_id, '-reversed');
      if ($pos === false)
      {
        $jdata->sort_column = $sort_id;
      }
      else
      {
        $jdata->sort_reversed = true;
        $jdata->sort_column = substr($sort_id, 0, $pos);
      }

      $this->do_sort = true;

      // Get sort type
      $ltype = $search_items[$jdata->sort_column]['type'];
      if (('int_max' == $ltype) || ('int_min' == $ltype)) {
        $this->sort_type = 'integer';
      }
      else
      {
        $this->sort_type = 'string';
      }


    }
    else
    {
      // No sorting information found
      $this->do_sort = false;
    }

    // Save search items in session. Only save if search button has been clicked.
    if ($this->show_results)
    {
      if ($this->do_sort)
      {
        $_SESSION['session_sort_field']    = $jdata->sort_column;
        $_SESSION['session_sort_reversed'] = $jdata->sort_reversed;
      }
      else
      {
        unset($_SESSION['session_sort_field']);
        unset($_SESSION['session_sort_reversed']);
      }
    }

  }

  //-------------------------------------------------------------------
  // Set form defaults
  //-------------------------------------------------------------------
  function set_search_form_defaults(&$aform)
  {

    // Read search item values from SESSION
    if (isset($_SESSION['session_search_items']))
    {
      $stored_search_items = $_SESSION['session_search_items'];
    }

    if (! empty($stored_search_items))
    {
      // Loop through search items
      foreach ($stored_search_items as $search_item)
      {

        // Use htmlentities to prevent HTML injection
        $search_value = htmlentities($search_item['value']);

        // Match if search value is not empty
        if (! empty($search_value))
        {

          $search_name = $search_item['name'];

          // Find <input> tags and add value attribute
          set_input_tag_default($aform, $search_name, $search_value);

          // Find and set <select> tags
          set_select_tag_default($aform, $search_name, $search_value);
        }
      }
    }

    // Set sort default
    if (isset($_SESSION['session_sort_field']) && isset($_SESSION['session_sort_reversed']))
    {
      // Use HtmlEntities to prevent illegaly HTML
      $fieldname = htmlentities($_SESSION['session_sort_field']);

      set_sort_select_default($aform, 'sort', $fieldname, $_SESSION['session_sort_reversed']);
    }

  }

  //-------------------------------------------------------------------
  // Create search page HTML code
  //-------------------------------------------------------------------
  function get_HTML_search_page()
  {
    global $lang;

    // Read input data
    $this->extract_search_get_data();

    $this->extract_sort_get_data();

    // Load search result template
    $page = template_search();

    // Replace texts
    $page = str_replace("{category.headline}",     $lang['page_header'],       $page);
    $page = str_replace("{category.introduction}", $lang['page_introduction'], $page);
    $page = str_replace("{category.name}",         'Search',                   $page);

    $form = template_search_form();

    $this->set_search_form_defaults($form);

    // Replace {category.properties} tag with search results
    $page = str_replace("{category.properties}", $form, $page);

    return $page;
  }

  //-------------------------------------------------------------------
  // Return true if property matches search
  //-------------------------------------------------------------------
  function property_matches_search($property_row)
  {
    global $search_items;

    foreach ($search_items as $search_item)
    {

      $search_value = $search_item['value'];

      // Match if search value is not empty
      if (! empty($search_value))
      {


        $property_value = $property_row[$search_item['datacol']];


        // Check if property value matches
        switch ($search_item['type'])
        {

          case 'int_min':
          {

            if (! match_integer_min($property_value, $search_value))
            {
              return false;
            };

            break;
          }

          case 'int_max':
          {
            if (! match_integer_max($property_value, $search_value))
            {
              return false;
            }

            break;
          }

          case 'string_contains':
          {

            if (! match_string_contains($property_value, $search_value))
            {
              return false;
            }

            break;
          }

          case 'string_same':
          {

            if (! match_string_same($property_value, $search_value))
            {
              return false;
            }


            break;
          }

        } // end switch

      }

    }

    return true;
  }


  //-------------------------------------------------------------------
  // Create search results page HTML code
  //-------------------------------------------------------------------
  function get_HTML_search_page_results()
  {
    global $lang;

    // Read data from GET
    $this->extract_search_get_data();

    $this->extract_sort_get_data();

    // Load search result template
    $page = template_search_results();

    // Replace texts
    $page = str_replace("{category.headline}",     $lang['resultspage_header'],       $page);
    $page = str_replace("{category.introduction}", $lang['resultspage_introduction'], $page);
    $page = str_replace("{category.name}",         'Results',                         $page);

    // Get search HTML code
    $code = $this->get_HTML_properties_code();

    // Replace {category.properties} tag with search results code
    $page = str_replace("{category.properties}", $code, $page);

    // Add navigation
    $this->add_results_page_navigation($page);

    return $page;
  }


  //-------------------------------------------------------------------
  // Remove navigation section
  //-------------------------------------------------------------------
  function nav_match_callback($amatches, $asection_name)
  {

    if (stristr($amatches, $asection_name) == true)
    {
      return '';
    }
    else
    {
      // The regular expression e modifier adds slashes to quotes. We remove them here.
      return stripslashes($amatches);
    }
  }


  function remove_navigation_section(&$acode, $asection_name)
  {

    // Create regular expression
    // Sections begin with  "// <!-- StartSectionName -->"
    // and end with "// <!-- EndSectionName -->"
    // i: case insensitive
    // s: dot includes newlines
    // e: Evaluate the return string as PHP enabling the callback
    $expression =
        '/<\!--\s*BeginNavigationElement\s*-->' .
        '.*?<\!--\s*EndNavigationElement\s*-->/ise';

    // A call back function is used for the actual replacement.
    $acode = preg_replace(
      $expression,
      "\$this->nav_match_callback('\\0', '$asection_name')",
      $acode);
  }

  //-------------------------------------------------------------------
  // Create search results page HTML code
  //-------------------------------------------------------------------
  function add_results_page_navigation(&$acode)
  {
    global $start, $jdata;

    if ($start > 1)
    {

      $acode = str_replace('{navigation_first}', $this->get_navigation_URL(1), $acode);


      $start_previous = $start - $jdata->max_properties_per_page;
      $acode = str_replace('{navigation_previous}', $this->get_navigation_URL($start_previous), $acode);
    }
    else
    {
      // Remove first and previous items
      $this->remove_navigation_section($acode, '{navigation_first}');
      $this->remove_navigation_section($acode, '{navigation_previous}');
    }

    $start_next = $start + $jdata->max_properties_per_page;
    if ($this->properties_found >= $start_next)
    {

      $acode = str_replace('{navigation_next}', $this->get_navigation_URL($start_next), $acode);

      $start_last =
        $this->properties_found -
        ($this->properties_found % $jdata->max_properties_per_page) + 1;

      $acode = str_replace('{navigation_last}', $this->get_navigation_URL($start_last), $acode);
    }
    else
    {
      // Remove first and previous items
      $this->remove_navigation_section($acode, '{navigation_next}');
      $this->remove_navigation_section($acode, '{navigation_last}');
    }
  }

  //-------------------------------------------------------------------
  // Search results, properties code
  //-------------------------------------------------------------------
  function get_HTML_properties_code()
  {
  global $properties, $lang, $search_items, $jdata, $start;

      // Exit if no properties found
    if (count($properties) <= 0)
    {
      return 'No properties found';
      exit;
    }

    $code                      = '';
    $matching_properties_index = 0;  // zero based property index
    $id_colindex               = $search_items["id"]["datacol"];
    $sorting_colindex          = $search_items[$jdata->sort_column]["datacol"];


    // --- Get array of matching properties ---

    // Initialize $matching_properties. We get errors if 0 matches are found and don't do this.
    $matching_properties = '';

    // Build matching properties array
    foreach ($properties as $property_row)
    {

      // Check if property matches search conditions
      if ($this->property_matches_search($property_row))
      {
        // Add ID and sorting columns to matching_properties array
        $matching_properties[] = array($property_row[$id_colindex], $property_row[$sorting_colindex]);
      }
    }

    // Store properties found value
    $this->properties_found = count($matching_properties);

    // --- Generate properties listing ---
    if ($this->properties_found > 0)
    {

      // --- Sort results ---
      if (($this->do_sort) && ($this->properties_found > 1))
      {
        if ($this->sort_type = 'integer')
        {
          if ($jdata->sort_reversed)
          {
            usort($matching_properties, 'compare_int_reversed');
          }
          else
          {
            usort($matching_properties, 'compare_int');
          }
        }
        else
        {
          if ($jdata->sort_reversed)
          {
            usort($matching_properties, 'compare_string_reversed');
          }
          else
          {
            usort($matching_properties, 'compare_string');
          }
        }
      }

      // Delete properties before start value
      if ($start > 1) {

        $matching_properties = array_splice($matching_properties, $start - 1);
      }

      // --- Build results HTML table ---

      // Loop through properties
      if (! empty($matching_properties))
      {
        foreach ($matching_properties as $property_row)
        {

          if ($matching_properties_index >= $jdata->max_properties_per_page)
          {
            break;
          }


          // Load property row template from file
          $filename = "search/property_rows/property{$property_row[$id_colindex]}.html";
          $property_code = get_HTML_table_column_begin() . file_get_contents($filename) . get_HTML_table_column_end();

          // Add table row begin
          if ($matching_properties_index % $jdata->property_column_count == 0)
          {
            $property_code = get_HTML_table_row_begin() . $property_code;
          }

          // Add table row end
          if ($matching_properties_index % $jdata->property_column_count == $jdata->property_column_count - 1)
          {
            $property_code .= get_HTML_table_row_end();
          }

          $code .= $property_code;

          if ($matching_properties_index >= $jdata->max_properties_per_page)
          {
            break;
          }

          $matching_properties_index += 1;
        }
      }

    }


    if ($matching_properties_index > 0)
    {

      // Add empty cells to complete table row
      $col_index = $matching_properties_index % $jdata->property_column_count;

      // Calculate the number of empty cells
      if (($matching_properties_index > $jdata->property_column_count) && ($col_index > 0))
      {
        $empty_cell_count = $jdata->property_column_count - $col_index;
      }
      else
      {
        $empty_cell_count = 0;
      }

      // Add empty cells code
      if ($empty_cell_count > 0)
      {

        for ($i = 0; $i < $empty_cell_count; $i++)
        {
          $code .= get_HTML_table_column_begin() . '&nbsp;' . get_HTML_table_column_end();
        }

        $code .= get_HTML_table_row_end();
      }

      // Replace "width" attributes
      $col_count = min($matching_properties_index, $jdata->property_column_count);
      $col_width = round(100 * 1 / $col_count);

      $code = str_replace('{width}', 'width="' . $col_width . '%"', $code);

      // Add table tags
      $code = get_html_table_begin() . $code . get_html_table_end();

    }
    else
    {
      // Display no properties found message
      $code = get_HTML_no_properties();
      $code = str_replace('{category.nopropertieslabel}', $lang['no_properties_found'], $code);
    }


    return $code;
  }
}

?>