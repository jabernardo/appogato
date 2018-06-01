<div id="lollipop-debug">
    <div id="lollipop-debug-header">
        <a href="javascript:" ldebug-toggle="app">
            LMVC
        </a>
        <a href="javascript:" ldebug-toggle="files">
            Files <span class="count"><?= count(get_included_files()) ?></span>
        </a>
        <a href="javascript:" ldebug-toggle="session">
            Session <span class="count"><?= count($session) ?></span>
        </a>
        <a href="javascript:" ldebug-toggle="request">
            Requests <span class="count"><?= count($request) ?></span>
        </a>
        <a href="javascript:" ldebug-toggle="config">
            Config
        </a>
        <?php if (isset($route)) { ?>
        <a href="javascript:" ldebug-toggle="route">
            Route
        </a>
        <?php } ?>
        <?php if (count($logs->info) ||
                count($logs->warn) ||
                count($logs->error) ||
                count($logs->fatal) ||
                count($logs->debug))
         { ?>
        <span class="separator"></span>
        <?php } ?>
        <?php if (count($logs->info)) { ?>
        <a href="javascript:" ldebug-toggle="logs">
            Logs <span class="count"><?= count(array_merge($logs->info, $logs->debug)) ?></span>
        </a>
        <?php } ?>
        <?php if (count($logs->warn)) { ?>
        <a href="javascript:" ldebug-toggle="warns">
            Warnings <span class="count"><?= count($logs->warn) ?></span>
        </a>
        <?php } ?>
        <?php if (count($logs->error)) { ?>
        <a href="javascript:" ldebug-toggle="error">
            Errors <span class="count"><?= count($logs->error) ?></span>
        </a>
        <?php } ?>
        <?php if (count($logs->fatal)) { ?>
        <a href="javascript:" ldebug-toggle="fatal">
            Fatal <span class="count"><?= count($logs->fatal) ?></span>
        </a>
        <?php } ?>
        <span class="separator"></span>
        <?php
            $color = "green";
            
            if ($benchmark->response->time > 1) {
                $color = "red";
            } else if ($benchmark->response->time > 0.02) {
                $color =  "orange";
            }
        ?>
        
        <span class="blue"><?= $benchmark->response->memory_used ?></span> at <span class="<?= $color ?>"><?= $benchmark->response->time ?>s</span>
        <a href="javascript:" class="close" style="display: none">
            X
        </a>
    </div>
    <div id="lollipop-debug-body">
        <div id="lollipop-debug-tab-app">
            <?= $app->name ?> v<?= $app->version ?><br>
            by <?= $app->author ?>
        </div>
        <div id="lollipop-debug-tab-files">
            <ul>
            <?php foreach (get_included_files() as $file) { ?>
            <li><?= $file ?></li>
            <?php } ?>
            </ul>
        </div>
        <div id="lollipop-debug-tab-session">
            <ul>
            <?php foreach ($session as $key => $val) { ?>
            <li><span class="key"><?= $key ?></span> <?= $val?></li>
            <?php } ?>
            </ul>
        </div>
        <div id="lollipop-debug-tab-request">
            <ul>
            <?php foreach ($request as $key => $val) { ?>
            <li><span class="key"><?= $key ?></span> <?= $val?></li>
            <?php } ?>
            </ul>
        </div>
        <div id="lollipop-debug-tab-config">
            <ul>
            <?php foreach ($config as $k => $v) { ?>
            <li><span class="key"><?= $k ?></span><span><?php $v ? print_r($v) : print('null') ?></span></li>
            <?php } ?>
            </ul>
        </div>
        <?php if (isset($route)) { ?>
        <div id="lollipop-debug-tab-route">
            <pre><?php print_r($route) ?></pre>
        </div>
        <?php } ?>
        <?php if (count($logs->info)) { ?>
        <div id="lollipop-debug-tab-logs">
            <ul>
            <?php foreach (array_merge($logs->info, $logs->debug) as $log) { ?>
            <li><?= $log ?></li>
            <?php } ?>
            </ul>
        </div>
        <?php } ?>
        <?php if (count($logs->warn)) { ?>
        <div id="lollipop-debug-tab-warns">
            <ul>
            <?php foreach ($logs->warn as $warn) { ?>
            <li><?= $warn ?></li>
            <?php } ?>
            </ul>
        </div>
        <?php } ?>
        <?php if (count($logs->error)) { ?>
        <div id="lollipop-debug-tab-error">
            <ul>
            <?php foreach ($logs->error as $error) { ?>
            <li><?= $error ?></li>
            <?php } ?>
            </ul>
        </div>
        <?php } ?>
        <?php if (count($logs->fatal)) { ?>
        <div id="lollipop-debug-tab-fatal">
            <ul>
            <?php foreach ($logs->fatal as $fatal) { ?>
            <li><?= $fatal ?></li>
            <?php } ?>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>
<style type="text/css">

#lollipop-debug {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 1em;
    width: 100%;
    position: fixed;
    bottom: 0;
    border-top: 2px solid #3320bd;
    z-index: 20000;
    background-color: #f1f1f1;
}

@media (max-width: 640px) {
    #lollipop-debug {
        display: none;
    }
}

#lollipop-debug.active {
    top: 0;
    left: 0;
    position: fixed;
    height: 100%;
    width: 100%;
    z-index: 20000;
}

#lollipop-debug span.key {
    color: #ffffff;
    background-color: #5d5d5d;
    padding: 2px;
    border-radius: 2px;
    margin-right: 2px;
}

#lollipop-debug a,
#lollipop-debug a:hover,
#lollipop-debug a:visited {
    outline: none;
}

#lollipop-debug .blue {
    color: blue;
}

#lollipop-debug .green {
    color: green;
}

#lollipop-debug .orange {
    color: orange;
}

#lollipop-debug .red {
    color: red;
}

#lollipop-debug #lollipop-debug-header {
    width: 100%;
    background-color: #efefef;
}

#lollipop-debug #lollipop-debug-header span.separator {
    border-left: solid 1px #b7b7b7;
    margin-left: 3px;
    margin-right: 3px;
}

#lollipop-debug #lollipop-debug-header a,
#lollipop-debug #lollipop-debug-header a:visited,
#lollipop-debug #lollipop-debug-header a:hover {
    display: inline-block;
    padding: 4px;
    text-decoration: none;
    font-weight: bold;
    color: #3320bd;
    margin: 0 0 0 0;
}

#lollipop-debug #lollipop-debug-header a.active {
    color: #fff;
    background-color: #3320bd;
}

#lollipop-debug #lollipop-debug-header a.close {
    border-radius: 50%;
    float: right;
}

#lollipop-debug #lollipop-debug-header a span.count {
    font-size: 10px;
    border-radius: 3px;
    color: #ffffff;
    padding: 3px;
    background-color: #4e4e4e;
}

#lollipop-debug #lollipop-debug-header a.active span.count {
    color: #3320bd;
    background-color: #ffffff;
}

#lollipop-debug #lollipop-debug-header a span.count:before {
    content: "[";
}

#lollipop-debug #lollipop-debug-header a span.count:after {
    content: "]";
}

#lollipop-debug #lollipop-debug-body {
    overflow-y: auto;
    position: relative;
    height: 96.333333%;
    border-top: 1px solid #b7b7b7;
}

#lollipop-debug #lollipop-debug-body div[id^="lollipop-debug-tab-"] {
    display: none;
}

#lollipop-debug #lollipop-debug-body div[id^="lollipop-debug-tab-"].active {
    display: block;
    position: relative;
}

#lollipop-debug #lollipop-debug-body ul {
    list-style: none;
}

#lollipop-debug #lollipop-debug-body ul li {
    background: #f1f1f1;
    margin-left: 0.2rem;
    margin-bottom: 0;
    padding-bottom: 0.5px;
    border-bottom: dashed 1px #e8e8e8;
}

#lollipop-debug #lollipop-debug-body ul li:hover {
    background: #dbdbdb;
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="fatal"] {
    color: #ff0000;
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="fatal"].active {
    color: #ffffff;
    background-color: #ff0000;
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="fatal"].active span.count {
    color: #ff0000;
    background-color: #ffffff;
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="logs"] {
    color: rgb(24, 136, 152);
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="logs"].active {
    color: #ffffff;
    background-color: rgb(24, 136, 152);
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="logs"].active span.count {
    color: rgb(24, 136, 152);
    background-color: #ffffff;
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="warns"] {
    color: rgb(214, 124, 13);
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="warns"].active {
    color: #ffffff;
    background-color: rgb(214, 124, 13);
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="warns"].active span.count {
    color: rgb(214, 124, 13);
    background-color: #ffffff;
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="error"] {
    color: rgb(162, 151, 13);
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="error"].active {
    color: #ffffff;
    background-color: rgb(162, 151, 13);
}

#lollipop-debug #lollipop-debug-header a[ldebug-toggle="error"].active span.count {
    color: rgb(162, 151, 13);
    background-color: #ffffff;
}

</style>
<script type="text/javascript">

/***************************************************/
/***        SELECT *********************************/
/***************************************************/

/**
 * Select Object
 * 
 * @param   {String}    DOM Selector
 * @return  {Object}    window._.select
 * 
 */
var _ = function(selector) {
    // Create new instance of `select`
    var ins = new window._.select(selector);
    
    // Set count
    ins.length = ins._item.length;
    
    return ins;
}

/**
 * Select Item Object
 * 
 * @param   {String}    DOM Selector
 * 
 */
_.select = function(selector) {
    if (typeof selector === "string") {
        this._item = document.querySelectorAll(selector);
    } else if (typeof selector === "object") {
        this._item = [selector];
    } else {
        return false;
    }
}

/**
 * Selected elements length
 * 
 * @var int length  Document count
 * 
 */
_.select.length = 0;

/**
 * Register event
 * 
 * @param   {String}    selector    Selector
 * @param   {String}    event       Event type
 * @param   {function}  callback    Callback function
 * @return  {Object}
 * 
 */
_.select.prototype.on = function(event, callback) {
    var elem = this._item;
    
    if (typeof callback !== "function") return;
    
    for (var i = 0; i < elem.length; i++) {
        event.split(" ").forEach(function(e) {
            if (typeof elem[i].addEventListener === "undefined") return;
            
            elem[i].addEventListener(e, callback, false);
        });
    }
    
    return this;
};

/**
 * Ready function
 * 
 * @param   {function}  fn  Function
 * @return  {Object}
 * 
 */
_.select.prototype.ready = function(fn) {
    // Sanity check
    if (typeof fn !== 'function') return;

    // If document is already loaded, run method
    if (document.readyState === 'complete') {
        return fn();
    }

    // Otherwise, wait until document is loaded
    document.addEventListener('DOMContentLoaded', fn, false);
    
    return this;
};

/**
 * Add class
 * 
 * @param   {String}    name    Name of class
 * @return  {Object}
 * 
 */
_.select.prototype.addClass = function(name) {
    var elem = this._item;
    
    for (var i = 0; i < elem.length; i++) {
        if (typeof elem[i].getAttribute !== "undefined") {
            if (!elem[i].hasAttribute("class")) {
                elem[i].setAttribute("class", "");
            }
            
            var vals = elem[i].getAttribute("class") ? elem[i].getAttribute("class").split(" ") : [];
            
            if (vals.indexOf(name) === -1) {
                vals.push(name);
            }
            
            elem[i].setAttribute("class", vals.join(" "));
        }
    }
    
    return this;
}

/**
 * Remove class from element
 * 
 * @param   {String}    name    Class name
 * @return  {Object}
 * 
 */
_.select.prototype.removeClass = function(name) {
    var elem = this._item;
    
    for (var i = 0; i < elem.length; i++) {
        if (typeof elem[i].getAttribute !== "undefined") {
            if (!elem[i].hasAttribute("class")) {
                elem[i].setAttribute("class", "");
            }
            
            var vals = elem[i].getAttribute("class") ? elem[i].getAttribute("class").split(" ") : [];
            var vals_new = [];
            
            vals.forEach(function(v) {
               if (v !== name) {
                   vals_new.push(v);
               }
            });
            
            elem[i].setAttribute("class", vals_new.join(" "));
        }
    }
    
    return this;
}

/**
 * Has class prototype
 * 
 * @param   {String}    name    Class name
 * @return  {Boolean}
 * 
 */
_.select.prototype.hasClass = function(name) {
    var elem = this._item;
    var found = false;
    
    for (var i = 0; i < elem.length; i++) {
        if (typeof elem[i].getAttribute !== "undefined") {
            if (!elem[i].hasAttribute("class")) {
                elem[i].setAttribute("class", "");
            }
            
            var vals = elem[i].getAttribute("class") ? elem[i].getAttribute("class").split(" ") : [];
            
            vals.forEach(function(v) {
               if (v === name) {
                   found = true;
                   return true;
               }
            });
        }
    }
    
    return found;
}

/**
 * Toggle class prototype
 * 
 * @param   {String}    name    Class name
 * @return  {Object}
 * 
 */
_.select.prototype.toggleClass = function(name) {
    var elem = this._item;
    
    for (var i = 0; i < elem.length; i++) {
        var found = false;
        
        if (typeof elem[i].getAttribute !== "undefined") {
            if (!elem[i].hasAttribute("class")) {
                elem[i].setAttribute("class", "");
            }
            
            var vals = elem[i].getAttribute("class") ? elem[i].getAttribute("class").split(" ") : [];
            var vals_new = [];
            
            vals.forEach(function(v) {
               if (v === name) {
                   found = true;
               }
            });
            
            if (found) {
                vals.forEach(function(v) {
                   if (v !== name) {
                       vals_new.push(v);
                   }
                });
            } else {
                vals_new = vals;
                vals_new.push(name);
            }
            
            elem[i].setAttribute("class", vals_new.join(" "));
        }
    }
    
    return this;
}

/**
 * Set or get attribute
 * 
 * @param   {String}    name    Attribute name
 * @param   {String}    val     Value to be set
 * @return  {Mixed}
 * 
 */
_.select.prototype.attr = function(name, val) {
    var elem = this._item;
    
    if (typeof val !== "undefined") {
        for (var i = 0; i < 1; i++) {
            if (typeof elem[i].getAttribute !== "undefined") {
                elem[i].setAttribute(name, val);
                return this;
            }
        }
    }
    
    return typeof elem[0] !== "undefined" ? elem[0].getAttribute(name) : null;
}

/**
 * Toggle display
 * 
 * @return  {Object}
 * 
 */
_.select.prototype.toggle = function() {
    var elem = this._item;
    
    for (var i = 0; i < elem.length; i++) {
        if (typeof elem[i].style !== "undefined") {
            if (elem[i].style.visibility === "visible" ||
                elem[i].style.visibility === "initial" ||
                elem[i].style.visibility === "") {
                elem[i].style.visibility = "hidden";
                elem[i].style.display = "none";
            } else {
                elem[i].style.visibility = "visible";
                elem[i].style.display = "initial";
            }
        }
    }
    
    return this;
}

/**
 * Show elemements selected
 * 
 * @return  {Object}
 * 
 */
_.select.prototype.show = function() {
    var elem = this._item;
    
    for (var i = 0; i < elem.length; i++) {
        if (typeof elem[i].style !== "undefined") {
            elem[i].style.visibility = "visible";
            elem[i].style.display = "initial";
        }
    }
    
    return this;
}

/**
 * Hide elements selected
 * 
 * @return  {Object}
 * 
 */
_.select.prototype.hide = function() {
    var elem = this._item;
    
    for (var i = 0; i < elem.length; i++) {
        if (typeof elem[i].style !== "undefined") {
            elem[i].style.visibility = "hidden";
            elem[i].style.display = "none";
        }
    }
    
    return this;
}

/**
 * Get or set innerHTML
 * 
 * @param   {String}    str    HTML Code
 * @return  {Mixed}
 * 
 */
_.select.prototype.html = function(str) {
    var elem = this._item;
    var iter = (typeof str !== "undefined") ? elem.length : 1;
    
    for (var i = 0; i < iter; i++) {
        if (typeof elem[i].innerHTML !== "undefined") {
            if (typeof str !== "undefined") {
                elem[i].innerHTML = str;
            } else {
                return elem[i].innerHTML;
            }
        }
    }
    
    return this;
}

/**
 * Get or set innerText
 * 
 * @param   {String}    str    innerText
 * @return  {Mixed}
 * 
 */
_.select.prototype.text = function(str) {
    var elem = this._item;
    var iter = (typeof str !== "undefined") ? elem.length : 1;
    
    for (var i = 0; i < iter; i++) {
        if (typeof elem[i].innerText !== "undefined") {
            if (typeof str !== "undefined") {
                elem[i].innerText = str;
            } else {
                return elem[i].innerText;
            }
        }
    }
    
    return this;
}

/**
 * Get or set value
 * 
 * @param   {String}    str    Value
 * @return  {Mixed}
 * 
 */
_.select.prototype.val = function(str) {
    var elem = this._item;
    var iter = (typeof str !== "undefined") ? elem.length : 1;
    
    for (var i = 0; i < iter; i++) {
        if (typeof elem[i].value !== "undefined") {
            if (typeof str !== "undefined") {
                elem[i].value = str;
            } else {
                return elem[i].value;
            }
        }
    }
    
    return this;
}


/***************************************************/
/***    END SELECT *********************************/
/***************************************************/

window.LollipopDebug = {};

window.LollipopDebug.create = function() {
    _("[ldebug-toggle]").on("click", function() {
       var tab = "#lollipop-debug-tab-" + _(this).attr("ldebug-toggle");
       
       if (!_(this).hasClass("active")) {
            _("[ldebug-toggle]").removeClass("active");
            _("[id^=lollipop-debug-tab-]").removeClass("active");
            _("#lollipop-debug").addClass("active");
            _(tab).addClass("active");
            _(this).addClass("active");
            _("#lollipop-debug #lollipop-debug-header a.close").show();
       } else {
            _("#lollipop-debug").removeClass("active");
            _("[ldebug-toggle]").removeClass("active");
            _("[id^=lollipop-debug-tab-]").removeClass("active");
            _("#lollipop-debug #lollipop-debug-header a.close").hide();
       }
    });
    
    _("#lollipop-debug #lollipop-debug-header a.close").on("click", function() {
        _("#lollipop-debug").removeClass("active");
        _("#lollipop-debug #lollipop-debug-header a.close").hide();
        _("[ldebug-toggle]").removeClass("active");
        _("[id^=lollipop-debug-tab-]").removeClass("active");
    });
}

_(document).ready(function() {
   window.LollipopDebug.create();
});

</script>