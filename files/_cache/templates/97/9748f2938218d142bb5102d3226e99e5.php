<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* pages/assets/cable.html.twig */
class __TwigTemplate_267130c3db8fe82e320e518a103ea0b2 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'more_fields' => [$this, 'block_more_fields'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "generic_show_form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "pages/assets/cable.html.twig", 35)->unwrap();
        // line 36
        $context["params"] = (($context["params"]) ?? ([]));
        // line 34
        $this->parent = $this->loadTemplate("generic_show_form.html.twig", "pages/assets/cable.html.twig", 34);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 38
    public function block_more_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 39
        yield "   ";
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["CableStrand", "cablestrands_id", (($__internal_compile_0 = CoreExtension::getAttribute($this->env, $this->source,         // line 42
($context["item"] ?? null), "fields", [], "any", false, false, false, 42)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["cablestrands_id"] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("CableStrand"),         // line 44
($context["field_options"] ?? null)], 39, $context, $this->getSourceContext());
        // line 45
        yield "

   ";
        // line 47
        yield CoreExtension::callMacro($macros["fields"], "macro_colorField", ["color", (($__internal_compile_1 = CoreExtension::getAttribute($this->env, $this->source,         // line 49
($context["item"] ?? null), "fields", [], "any", false, false, false, 49)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["color"] ?? null) : null), __("Color"),         // line 51
($context["field_options"] ?? null)], 47, $context, $this->getSourceContext());
        // line 52
        yield "

   <div class=\"mx-n3 d-flex\">
      ";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(["a", "b"]);
        foreach ($context['_seq'] as $context["_key"] => $context["side"]) {
            // line 56
            yield "         ";
            $context["rand_side"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
            // line 57
            yield "         ";
            $context["side_options"] = Twig\Extension\CoreExtension::merge(($context["field_options"] ?? null), ["full_width" => true, "full_width_adapt_column" => false, "rand" =>             // line 60
($context["rand_side"] ?? null)]);
            // line 62
            yield "         ";
            $context["html_side"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                // line 63
                yield "            <div class=\"card mx-n2 border-0 shadow-none\">

               ";
                // line 65
                $context["side_heading"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 66
                    yield "                  <h4 class=\"card-title\">
                     ";
                    // line 67
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::sprintf(__("Endpoint %s"), Twig\Extension\CoreExtension::upper($this->env->getCharset(), $context["side"])), "html", null, true);
                    yield "
                  </h4>
               ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 70
                yield "               <div class=\"card-header\">
               ";
                // line 71
                yield CoreExtension::callMacro($macros["fields"], "macro_field", ["",                 // line 73
($context["side_heading"] ?? null), "",                 // line 75
($context["side_options"] ?? null)], 71, $context, $this->getSourceContext());
                // line 76
                yield "
               </div>

               <div class=\"card-body row\">
                  ";
                // line 80
                $context["dropdown_item"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 81
                    yield "                     <span id=\"show_items_id_endpoint_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield "_field\" class=\"input_rear_listener\">
                        ";
                    // line 82
                    $context["current_itemtype"] = (($__internal_compile_2 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 82)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2[("itemtype_endpoint_" . $context["side"])] ?? null) : null);
                    // line 83
                    yield "                        ";
                    yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", [                    // line 84
($context["current_itemtype"] ?? null), ("items_id_endpoint_" .                     // line 85
$context["side"]), (($__internal_compile_3 = CoreExtension::getAttribute($this->env, $this->source,                     // line 86
($context["item"] ?? null), "fields", [], "any", false, false, false, 86)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3[("items_id_endpoint_" . $context["side"])] ?? null) : null), "", Twig\Extension\CoreExtension::merge(                    // line 88
($context["side_options"] ?? null), ["no_label" => true])], 83, $context, $this->getSourceContext());
                    // line 91
                    yield "
                     </span>
                  ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 94
                yield "
                  ";
                // line 95
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", [("itemtype_endpoint_" .                 // line 96
$context["side"]), (($__internal_compile_4 = CoreExtension::getAttribute($this->env, $this->source,                 // line 97
($context["item"] ?? null), "fields", [], "any", false, false, false, 97)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4[("itemtype_endpoint_" . $context["side"])] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Glpi\\Socket::getSocketLinkTypes"), _n("Asset", "Assets", 1), Twig\Extension\CoreExtension::merge(                // line 100
($context["side_options"] ?? null), ["add_field_html" =>                 // line 101
($context["dropdown_item"] ?? null)])], 95, $context, $this->getSourceContext());
                // line 103
                yield "

                  ";
                // line 105
                $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Ajax::updateItemOnSelectEvent", [(("dropdown_itemtype_endpoint_" .                 // line 106
$context["side"]) . ($context["rand_side"] ?? null)), (("show_items_id_endpoint_" .                 // line 107
$context["side"]) . "_field"), ($this->extensions['Glpi\Application\View\Extension\ConfigExtension']->config("root_doc") . "/ajax/cable.php"), ["itemtype" => "__VALUE__", "dom_name" => ("items_id_endpoint_" .                 // line 111
$context["side"]), "action" => "get_items_from_itemtype", "dom_rand" =>                 // line 113
($context["rand_side"] ?? null)]]);
                // line 116
                yield "
                  ";
                // line 117
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Glpi\\SocketModel", ("socketmodels_id_endpoint_" .                 // line 119
$context["side"]), (($__internal_compile_5 = CoreExtension::getAttribute($this->env, $this->source,                 // line 120
($context["item"] ?? null), "fields", [], "any", false, false, false, 120)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5[("socketmodels_id_endpoint_" . $context["side"])] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Glpi\\SocketModel"),                 // line 122
($context["side_options"] ?? null)], 117, $context, $this->getSourceContext());
                // line 123
                yield "

                  ";
                // line 125
                yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Glpi\\Socket", ("sockets_id_endpoint_" .                 // line 127
$context["side"]), (($__internal_compile_6 = CoreExtension::getAttribute($this->env, $this->source,                 // line 128
($context["item"] ?? null), "fields", [], "any", false, false, false, 128)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6[("sockets_id_endpoint_" . $context["side"])] ?? null) : null), $this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeName("Glpi\\Socket"), Twig\Extension\CoreExtension::merge(                // line 130
($context["side_options"] ?? null), ["condition" => ["socketmodels_id" => (($__internal_compile_7 = CoreExtension::getAttribute($this->env, $this->source,                 // line 132
($context["item"] ?? null), "fields", [], "any", false, false, false, 132)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7[("socketmodels_id_endpoint_" . $context["side"])] ?? null) : null), "itemtype" => (($__internal_compile_8 = CoreExtension::getAttribute($this->env, $this->source,                 // line 133
($context["item"] ?? null), "fields", [], "any", false, false, false, 133)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8[("itemtype_endpoint_" . $context["side"])] ?? null) : null), "items_id" => (($__internal_compile_9 = CoreExtension::getAttribute($this->env, $this->source,                 // line 134
($context["item"] ?? null), "fields", [], "any", false, false, false, 134)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9[("items_id_endpoint_" . $context["side"])] ?? null) : null)], "used" => (( !Twig\Extension\CoreExtension::testEmpty((($__internal_compile_10 = CoreExtension::getAttribute($this->env, $this->source,                 // line 136
($context["item"] ?? null), "fields", [], "any", false, false, false, 136)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10[("items_id_endpoint_" . $context["side"])] ?? null) : null))) ? ($this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("Glpi\\Socket::getSocketAlreadyLinked", [(($__internal_compile_11 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 136)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11[("itemtype_endpoint_" . $context["side"])] ?? null) : null), (($__internal_compile_12 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 136)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12[("items_id_endpoint_" . $context["side"])] ?? null) : null)])) : ([]))])], 125, $context, $this->getSourceContext());
                // line 138
                yield "

                  ";
                // line 140
                $context["asset_breadcrumb"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
                    // line 141
                    yield "                     <span id=\"show_";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield "_asset_breadcrumb\">
                        ";
                    // line 142
                    if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (($__internal_compile_13 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 142)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13[("items_id_endpoint_" . $context["side"])] ?? null) : null)) > 0)) {
                        // line 143
                        yield "                           ";
                        $context["breadcrumb"] = $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call(((($__internal_compile_14 = CoreExtension::getAttribute($this->env, $this->source, ($context["item"] ?? null), "fields", [], "any", false, false, false, 143)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14[("itemtype_endpoint_" . $context["side"])] ?? null) : null) . "::getDcBreadcrumbSpecificValueToDisplay"), [(($__internal_compile_15 = CoreExtension::getAttribute($this->env, $this->source,                         // line 144
($context["item"] ?? null), "fields", [], "any", false, false, false, 144)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15[("items_id_endpoint_" . $context["side"])] ?? null) : null)]);
                        // line 146
                        yield "                           ";
                        yield ($context["breadcrumb"] ?? null);
                        yield "
                        ";
                    }
                    // line 148
                    yield "                     </span>

                     <script>
                        //listener to remove socket selector and breadcrumb
                        \$(document).on('change', '#dropdown_itemtype_endpoint_";
                    // line 152
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand_side"] ?? null), "html", null, true);
                    yield "', function(e) {
                           \$('#show_";
                    // line 153
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield "_asset_breadcrumb').empty();
                           \$('#show_rear_sockets_field').empty();
                        });

                        //listener to refresh socket selector and breadcrumb
                        \$(document).on('change', '#dropdown_items_id_endpoint_";
                    // line 158
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand_side"] ?? null), "html", null, true);
                    yield "', function(e) {
                           var items_id = \$('#dropdown_items_id_endpoint_";
                    // line 159
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand_side"] ?? null), "html", null, true);
                    yield "').find(':selected').val();
                           var itemtype = \$('#dropdown_itemtype_endpoint_";
                    // line 160
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand_side"] ?? null), "html", null, true);
                    yield "').find(':selected').val();
                           var socketmodels_id = \$('#dropdown_socketmodels_id_endpoint_";
                    // line 161
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["rand_side"] ?? null), "html", null, true);
                    yield "').find(':selected').val();
                           refreshAssetBreadcrumb(itemtype, items_id, 'show_";
                    // line 162
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield "_asset_breadcrumb');
                           refreshSocketDropdown(itemtype, items_id, socketmodels_id, 'sockets_id_endpoint_";
                    // line 163
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["side"], "html", null, true);
                    yield "');

                        });
                     </script>
                  ";
                    return; yield '';
                })())) ? '' : new Markup($tmp, $this->env->getCharset());
                // line 168
                yield "                  ";
                yield CoreExtension::callMacro($macros["fields"], "macro_htmlField", ["position",                 // line 170
($context["asset_breadcrumb"] ?? null), __("Position"),                 // line 172
($context["side_options"] ?? null)], 168, $context, $this->getSourceContext());
                // line 173
                yield "
               </div>
            </div>
         ";
                return; yield '';
            })())) ? '' : new Markup($tmp, $this->env->getCharset());
            // line 177
            yield "
         ";
            // line 178
            yield CoreExtension::callMacro($macros["fields"], "macro_noLabelField", [            // line 179
($context["html_side"] ?? null)], 178, $context, $this->getSourceContext());
            // line 180
            yield "
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['side'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 182
        yield "   </div>
";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "pages/assets/cable.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  279 => 182,  272 => 180,  270 => 179,  269 => 178,  266 => 177,  259 => 173,  257 => 172,  256 => 170,  254 => 168,  245 => 163,  241 => 162,  236 => 161,  231 => 160,  226 => 159,  221 => 158,  213 => 153,  208 => 152,  202 => 148,  196 => 146,  194 => 144,  192 => 143,  190 => 142,  185 => 141,  183 => 140,  179 => 138,  177 => 136,  176 => 134,  175 => 133,  174 => 132,  173 => 130,  172 => 128,  171 => 127,  170 => 125,  166 => 123,  164 => 122,  163 => 120,  162 => 119,  161 => 117,  158 => 116,  156 => 113,  155 => 111,  154 => 107,  153 => 106,  152 => 105,  148 => 103,  146 => 101,  145 => 100,  144 => 97,  143 => 96,  142 => 95,  139 => 94,  133 => 91,  131 => 88,  130 => 86,  129 => 85,  128 => 84,  126 => 83,  124 => 82,  119 => 81,  117 => 80,  111 => 76,  109 => 75,  108 => 73,  107 => 71,  104 => 70,  97 => 67,  94 => 66,  92 => 65,  88 => 63,  85 => 62,  83 => 60,  81 => 57,  78 => 56,  74 => 55,  69 => 52,  67 => 51,  66 => 49,  65 => 47,  61 => 45,  59 => 44,  58 => 42,  56 => 39,  52 => 38,  47 => 34,  45 => 36,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/assets/cable.html.twig", "C:\\glpi\\templates\\pages\\assets\\cable.html.twig");
    }
}
