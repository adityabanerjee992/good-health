<?php

/* macros.twig */
class __TwigTemplate_a17b14d17ef73d4279405b96a856774ad0397b39454be38e578f892aa4744ad9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 4
        echo "
";
        // line 16
        echo "
";
        // line 24
        echo "
";
        // line 32
        echo "
";
        // line 48
        echo "
";
        // line 54
        echo "
";
        // line 58
        echo "
";
        // line 70
        echo "
";
        // line 91
        echo "
";
    }

    // line 1
    public function getnamespace_link($__namespace__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "namespace" => $__namespace__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "<a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, (isset($context["namespace"]) ? $context["namespace"] : $this->getContext($context, "namespace"))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, (isset($context["namespace"]) ? $context["namespace"] : $this->getContext($context, "namespace")), "html", null, true);
            echo "</a>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 5
    public function getclass_link($__class__ = null, $__absolute__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "class" => $__class__,
            "absolute" => $__absolute__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 6
            $context["__internal_149b90a998c029f350c9494d2b7962e525617294a42d6089be409dff26ae5abf"] = $this;
            // line 8
            if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "projectclass", array())) {
                // line 9
                echo "<a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForClass($context, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class"))), "html", null, true);
                echo "\">";
            } elseif ($this->getAttribute(            // line 10
(isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "phpclass", array())) {
                // line 11
                echo "<a target=\"_blank\" href=\"http://php.net/";
                echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "html", null, true);
                echo "\">";
            }
            // line 13
            echo $context["__internal_149b90a998c029f350c9494d2b7962e525617294a42d6089be409dff26ae5abf"]->getabbr_class((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), ((array_key_exists("absolute", $context)) ? (_twig_default_filter((isset($context["absolute"]) ? $context["absolute"] : $this->getContext($context, "absolute")), false)) : (false)));
            // line 14
            if (($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "projectclass", array()) || $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "phpclass", array()))) {
                echo "</a>";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 17
    public function getmethod_link($__method__ = null, $__absolute__ = null, $__classonly__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "method" => $__method__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 18
            $context["__internal_20b500e081a0e949ac6f71bf46cda0c1e31c0eeb3f7476519890a6da8e5a1b79"] = $this;
            // line 19
            echo "
    <a href=\"";
            // line 20
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForMethod($context, (isset($context["method"]) ? $context["method"] : $this->getContext($context, "method"))), "html", null, true);
            echo "\">";
            // line 21
            echo $context["__internal_20b500e081a0e949ac6f71bf46cda0c1e31c0eeb3f7476519890a6da8e5a1b79"]->getabbr_class($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "class", array()));
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) ? $context["classonly"] : $this->getContext($context, "classonly")), false)) : (false))) {
                echo "::";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "name", array()), "html", null, true);
            }
            // line 22
            echo "</a>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 25
    public function getproperty_link($__property__ = null, $__absolute__ = null, $__classonly__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "property" => $__property__,
            "absolute" => $__absolute__,
            "classonly" => $__classonly__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 26
            $context["__internal_3b9b0802d04ab50a2fd8c9f8d5c294b76aef73affc9262c9ab77318102c7f9b6"] = $this;
            // line 27
            echo "
    <a href=\"";
            // line 28
            echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForProperty($context, (isset($context["property"]) ? $context["property"] : $this->getContext($context, "property"))), "html", null, true);
            echo "\">";
            // line 29
            echo $context["__internal_3b9b0802d04ab50a2fd8c9f8d5c294b76aef73affc9262c9ab77318102c7f9b6"]->getabbr_class($this->getAttribute((isset($context["property"]) ? $context["property"] : $this->getContext($context, "property")), "class", array()));
            if ( !((array_key_exists("classonly", $context)) ? (_twig_default_filter((isset($context["classonly"]) ? $context["classonly"] : $this->getContext($context, "classonly")), true)) : (true))) {
                echo "#";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["property"]) ? $context["property"] : $this->getContext($context, "property")), "name", array()), "html", null, true);
            }
            // line 30
            echo "</a>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 33
    public function gethint_link($__hints__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "hints" => $__hints__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 34
            $context["__internal_b31fdf7cd9a01ca1d1ea9531e908055b60eaf412e4ed67680c797542601d1716"] = $this;
            // line 35
            echo "
    ";
            // line 36
            if ((isset($context["hints"]) ? $context["hints"] : $this->getContext($context, "hints"))) {
                // line 37
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["hints"]) ? $context["hints"] : $this->getContext($context, "hints")));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["hint"]) {
                    // line 38
                    if ($this->getAttribute($context["hint"], "class", array())) {
                        // line 39
                        echo $context["__internal_b31fdf7cd9a01ca1d1ea9531e908055b60eaf412e4ed67680c797542601d1716"]->getclass_link($this->getAttribute($context["hint"], "name", array()));
                    } elseif ($this->getAttribute(                    // line 40
$context["hint"], "name", array())) {
                        // line 41
                        echo $this->env->getExtension('sami')->abbrClass($this->getAttribute($context["hint"], "name", array()));
                    }
                    // line 43
                    if ($this->getAttribute($context["hint"], "array", array())) {
                        echo "[]";
                    }
                    // line 44
                    if ( !$this->getAttribute($context["loop"], "last", array())) {
                        echo "|";
                    }
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['hint'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 49
    public function getsource_link($__project__ = null, $__class__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "project" => $__project__,
            "class" => $__class__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 50
            if ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "sourcepath", array())) {
                // line 51
                echo "        (<a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "sourcepath", array()), "html", null, true);
                echo "\">View source</a>)";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 55
    public function getabbr_class($__class__ = null, $__absolute__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "class" => $__class__,
            "absolute" => $__absolute__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 56
            echo "<abbr title=\"";
            echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((((array_key_exists("absolute", $context)) ? (_twig_default_filter((isset($context["absolute"]) ? $context["absolute"] : $this->getContext($context, "absolute")), false)) : (false))) ? ((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class"))) : ($this->getAttribute((isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "shortname", array()))), "html", null, true);
            echo "</abbr>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 59
    public function getmethod_parameters_signature($__method__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "method" => $__method__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 60
            $context["__internal_d72dde74f4eead112edff06b2bb4af602aa013a318787c60288665737476baa7"] = $this->loadTemplate("macros.twig", "macros.twig", 60);
            // line 61
            echo "(";
            // line 62
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "parameters", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
                // line 63
                if ($this->getAttribute($context["parameter"], "hashint", array())) {
                    echo $context["__internal_d72dde74f4eead112edff06b2bb4af602aa013a318787c60288665737476baa7"]->gethint_link($this->getAttribute($context["parameter"], "hint", array()));
                    echo " ";
                }
                // line 64
                echo "\$";
                echo twig_escape_filter($this->env, $this->getAttribute($context["parameter"], "name", array()), "html", null, true);
                // line 65
                if ($this->getAttribute($context["parameter"], "default", array())) {
                    echo " = ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["parameter"], "default", array()), "html", null, true);
                }
                // line 66
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 68
            echo ")";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 71
    public function getrender_classes($__classes__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "classes" => $__classes__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 72
            $context["__internal_c42b1d8a00195102401276717dde960397f426d2b01043eebb02e808ceb9b3ef"] = $this;
            // line 73
            echo "
    <div class=\"container-fluid underlined\">
        ";
            // line 75
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["classes"]) ? $context["classes"] : $this->getContext($context, "classes")));
            foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
                // line 76
                echo "            <div class=\"row\">
                <div class=\"col-md-6\">
                    ";
                // line 78
                if ($this->getAttribute($context["class"], "isInterface", array())) {
                    // line 79
                    echo "                        <em>";
                    echo $context["__internal_c42b1d8a00195102401276717dde960397f426d2b01043eebb02e808ceb9b3ef"]->getclass_link($context["class"], true);
                    echo "</em>
                    ";
                } else {
                    // line 81
                    echo "                        ";
                    echo $context["__internal_c42b1d8a00195102401276717dde960397f426d2b01043eebb02e808ceb9b3ef"]->getclass_link($context["class"], true);
                    echo "
                    ";
                }
                // line 83
                echo "                </div>
                <div class=\"col-md-6\">
                    ";
                // line 85
                echo $this->env->getExtension('sami')->parseDesc($context, $this->getAttribute($context["class"], "shortdesc", array()), $context["class"]);
                echo "
                </div>
            </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 89
            echo "    </div>";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 92
    public function getbreadcrumbs($__namespace__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "namespace" => $__namespace__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 93
            echo "    ";
            $context["current_ns"] = "";
            // line 94
            echo "    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_split_filter($this->env, (isset($context["namespace"]) ? $context["namespace"] : $this->getContext($context, "namespace")), "\\"));
            foreach ($context['_seq'] as $context["_key"] => $context["ns"]) {
                // line 95
                echo "        ";
                if ((isset($context["current_ns"]) ? $context["current_ns"] : $this->getContext($context, "current_ns"))) {
                    // line 96
                    echo "            ";
                    $context["current_ns"] = (((isset($context["current_ns"]) ? $context["current_ns"] : $this->getContext($context, "current_ns")) . "\\") . $context["ns"]);
                    // line 97
                    echo "        ";
                } else {
                    // line 98
                    echo "            ";
                    $context["current_ns"] = $context["ns"];
                    // line 99
                    echo "        ";
                }
                // line 100
                echo "        <li><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('sami')->pathForNamespace($context, (isset($context["current_ns"]) ? $context["current_ns"] : $this->getContext($context, "current_ns"))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["ns"], "html", null, true);
                echo "</a></li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ns'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "macros.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  501 => 100,  498 => 99,  495 => 98,  492 => 97,  489 => 96,  486 => 95,  481 => 94,  478 => 93,  466 => 92,  455 => 89,  445 => 85,  441 => 83,  435 => 81,  429 => 79,  427 => 78,  423 => 76,  419 => 75,  415 => 73,  413 => 72,  401 => 71,  390 => 68,  374 => 66,  369 => 65,  366 => 64,  361 => 63,  344 => 62,  342 => 61,  340 => 60,  328 => 59,  313 => 56,  300 => 55,  286 => 51,  284 => 50,  271 => 49,  245 => 44,  241 => 43,  238 => 41,  236 => 40,  234 => 39,  232 => 38,  215 => 37,  213 => 36,  210 => 35,  208 => 34,  196 => 33,  185 => 30,  179 => 29,  176 => 28,  173 => 27,  171 => 26,  157 => 25,  146 => 22,  140 => 21,  137 => 20,  134 => 19,  132 => 18,  118 => 17,  105 => 14,  103 => 13,  98 => 11,  96 => 10,  92 => 9,  90 => 8,  88 => 6,  75 => 5,  60 => 2,  48 => 1,  43 => 91,  40 => 70,  37 => 58,  34 => 54,  31 => 48,  28 => 32,  25 => 24,  22 => 16,  19 => 4,);
    }
}
