var disqus_config;
var DsqLocal;
var disqus_callback;
var disqus_callback_params;
var disqus_category_id;
var disqus_container_id;
var disqus_custom_strings;
var disqus_def_email;
var disqus_def_name;
var disqus_default_text;
var disqus_dev;
var disqus_developer;
var disqus_domain;
var disqus_facebook_forum;
var disqus_facebook_key;
var disqus_frame_theme;
var disqus_identifier;
var disqus_iframe_css;
var disqus_message;
var disqus_shortname;
var disqus_thread_slug;
var disqus_skip_auth;
var disqus_sort;
var disqus_title;
var disqus_url;
var disqus_per_page;
var DISQUS = (function (h, d) {
    var e = 0,
        j = {},
        b = {
            running: false,
            timer: null,
            queue: [],
            beat: function () {
                if (b.queue.length === 0) {
                    return b.stop()
                }
                try {
                    if (b.queue[0][0]()) {
                        b.queue.shift()[1]()
                    }
                } catch (k) {
                    if (!(k instanceof a.AssertionError)) {
                        throw k
                    }
                }
            },
            stop: function () {
                b.running = false;
                clearInterval(b.timer)
            },
            start: function () {
                b.running = true;
                b.timer = setInterval(b.beat, 100)
            }
        },
        f = h.getElementsByTagName("head")[0] || h.getElementsByTagName("body")[0],
        i = {
            pool: [],
            add: function (k) {
                i.pool.push(k)
            },
            drain: function () {
                while (i.pool.length > 0) {
                    i.pool.shift()()
                }
            }
        },
        g = {},
        a = {
            config: {},
            browser: {
                ie: /msie/i.test(navigator.userAgent) && !/opera/i.test(navigator.userAgent),
                ie6: (!d.XMLHttpRequest) ? true : false,
                ie7: (h.all && !d.opera && d.XMLHttpRequest) ? true : false,
                webkit: navigator.userAgent.indexOf("AppleWebKit/") > -1,
                opera: !! (d.opera && d.opera.buildNumber),
                gecko: navigator.userAgent.indexOf("Gecko/") > -1,
                mobile: /(iPhone|Android|iPod|iPad|webOS|Mobile Safari|Windows Phone)/i.test(navigator.userAgent),
                quirks: (h.compatMode && h.compatMode === "BackCompat") ? true : false
            },
            blocks: {},
            status: null,
            modules: {}
        };
    a.settings = {
        realtime_url: "http://rt.disqus.com/forums/realtime.js",
        urls: {
            unmerged_profiles: "http://disqus.com/embed/profile/unmerged_profiles/"
        },
        minify_js: true,
        debug: false,
        disqus_url: "http://disqus.com",
        uploads_url: "http://media.disqus.com/uploads",
        recaptcha_public_key: "6LdKMrwSAAAAAPPLVhQE9LPRW4LUSZb810_iaa8u",
        media_url: "http://mediacdn.disqus.com/1299656234"
    };
    a.AssertionError = function (k) {
        this.message = k
    };
    a.AssertionError.prototype.toString = function () {
        return "AssertionError: " + this.message
    };
    a.assert = function (l, k) {
        if (!l) {
            throw new a.AssertionError(k)
        }
    };
    a.bind = function (l, m) {
        if (!j[l]) {
            j[l] = {}
        }
        var k = a.getGuid();
        m.guid = k;
        j[l][k] = m
    };
    a.unbind = function (l, k) {
        if (j[l] && j[l][k]) {
            delete j[l][k]
        }
    };
    a.contains = function (k, n) {
        for (var l = 0, m = k.length; l < m; l++) {
            if (k[l] == n) {
                return true
            }
        }
        return false
    };
    a.defer = function (k, l) {
        b.queue.push([k, l]);
        b.beat();
        if (!b.running) {
            b.start()
        }
    };
    a.each = function (o, p) {
        var m = o.length,
            n = Array.prototype.forEach;
        if (!isNaN(m)) {
            if (n) {
                n.call(o, p)
            } else {
                for (var l = 0; l < m; l++) {
                    p(o[l], l, o)
                }
            }
        } else {
            for (var k in o) {
                if (o.hasOwnProperty(k)) {
                    p(o[k], k, o)
                }
            }
        }
    };
    a.extend = function () {
        var l, k;
        if (arguments.length <= 1) {
            l = a;
            k = [arguments[0] || {}]
        } else {
            l = arguments[0] || {};
            k = Array.prototype.slice.call(arguments, 1)
        }
        DISQUS.each(k, function (m) {
            DISQUS.each(m, function (o, n) {
                l[n] = o
            })
        });
        return l
    };
    a.getGuid = function () {
        return e++
    };
    a.partial = function () {
        var l = arguments[0],
            k = Array.prototype.slice.call(arguments, 1);
        return function () {
            var o = Array.prototype.slice.call(arguments),
                p = [];
            for (var m = 0, n = k.length; m < n; m++) {
                p.push(k[m] === undefined ? o.shift() : k[m])
            }
            while (o.length > 0) {
                p.push(o.shift())
            }
            return l.apply(this, p)
        }
    };
    a.serializeArgs = function (l) {
        var k = [];
        DISQUS.each(l, function (n, m) {
            k.push(m + (n !== null ? "=" + encodeURIComponent(n) : ""))
        });
        return k.join("&")
    };
    a.serialize = function (l, o, m) {
        if (typeof o != "undefined") {
            l += (~l.indexOf("?") ? (l.charAt(l.length - 1) == "&" ? "" : "&") : "?");
            l += a.serializeArgs(o)
        }
        if (m) {
            var n = {};
            n[(new Date()).getTime()] = null;
            return a.serialize(l, n)
        }
        var k = l.length;
        return (l.charAt(k - 1) == "&" ? l.slice(0, k - 1) : l)
    };
    a.trigger = function (k, l) {
        l = l || {};
        if (!j[k]) {
            return
        }
        if (l.guid) {
            (j[k][l.guid] || (function () {})).call({
                guid: l.guid
            });
            return
        }
        DISQUS.each(j[k], function (n, m) {
            n.call({
                guid: m
            })
        })
    };
    a.useSSL = function (m) {
        if (!d.location.href.match("/^https/")) {
            return
        }
        var l, n = ["disqus_url", "media_url", "realtime_url", "uploads_url"];
        m = m || a.settings;
        for (var k = 0; k < n.length; k++) {
            l = n[k];
            if (typeof m[l] == "string") {
                m[l] = m[l].replace(/^http/, "https")
            }
        }
    };
    a.useSSL();
    a.ready = function (l) {
        function k() {
            var n = a.settings.media_url,
                m = n + "/javascript/embed/dtpl/",
                p = n + "/build/system/",
                o;
            DISQUS.status = "loading";
            DISQUS.requireStylesheet(n + "/styles/dtpl/defaults.css");
            if (DISQUS.settings.debug) {
                o = [m + "dtpl.js", m + "utils.js", m + "sandbox.js", m + "tooltip.js", m + "comm.js", m + "ui.js", m + "sso.js", m + "compat.js", p + "defaults.js", n + "/js/src/lib/easyxdm.js", n + "/js/src/json.js", DISQUS.settings.media_url + "/js/src/lib/stacktrace.js"]
            } else {
                o = [p + "disqus.js"]
            }
            DISQUS.requireSet(o, DISQUS.settings.debug, function () {
                DISQUS.status = "ready";
                i.drain()
            })
        }
        switch (DISQUS.status) {
        case "ready":
            l(DISQUS);
            break;
        case "loading":
            i.add(l);
            break;
        case null:
            i.add(l);
            k();
            break
        }
    };

    function c(l) {
        var k = l.currentTarget || l.srcElement;
        var m = k.getAttribute("data-callback-id");
        if (l.type === "load" || /^(complete|loaded)$/.test(k.readyState)) {
            if (typeof m !== null) {
                g[m]()
            }
            if (k.removeEventListener) {
                k.removeEventListener("load", c, false)
            } else {
                k.detachEvent("onreadystatechange", c)
            }
        }
    }
    a.require = function (l, o, m, p) {
        var k = h.createElement("script");
        k.src = DISQUS.serialize(l, o, m);
        k.async = true;
        k.charset = "UTF-8";
        if (p) {
            var n = DISQUS.getGuid();
            g[n] = p;
            k.setAttribute("data-callback-id", n);
            if (k.addEventListener) {
                k.addEventListener("load", c, false)
            } else {
                k.attachEvent("onreadystatechange", c)
            }
        }
        f.appendChild(k);
        return DISQUS
    };
    a.requireSet = function (m, l, n) {
        var k = m.length;
        DISQUS.each(m, function (o) {
            DISQUS.require(o, {}, l, function () {
                if (--k === 0) {
                    n()
                }
            })
        })
    };
    a.requireStylesheet = function (k, n, l) {
        var m = h.createElement("link");
        m.rel = "stylesheet";
        m.type = "text/css";
        m.href = DISQUS.serialize(k, n, l);
        f.appendChild(m);
        return a
    };
    a.addBlocks = function (m, n) {
        var l = DISQUS.modules;
        if (typeof n != "undefined") {
            return (function () {
                if (m == "all") {
                    n();
                    l.dtpl_defaults = true;
                    l.dtpl_theme = true
                } else {
                    if (m == "defaults") {
                        n();
                        l.dtpl_defaults = true
                    } else {
                        if (m == "theme") {
                            if (l.dtpl_defaults) {
                                n();
                                l.dtpl_theme = true
                            } else {
                                DISQUS.addJob(function () {
                                    return l.dtpl_defaults
                                }, function () {
                                    DISQUS.addBlocks(m, n)
                                })
                            }
                        }
                    }
                }
            }())
        }
        var k = function () {
            return {
                Builder: DISQUS.strings.Builder,
                renderBlock: DISQUS.renderBlock,
                each: DISQUS.each,
                extend: DISQUS.extend,
                blocks: DISQUS.blocks,
                interpolate: DISQUS.strings.interpolate
            }
        };
        if (typeof m == "undefined") {
            return function (o) {
                o(k());
                l.dtpl_defaults = true;
                l.dtpl_theme = true
            }
        } else {
            if (m == "defaults") {
                return function (o) {
                    o(k());
                    l.dtpl_defaults = true
                }
            } else {
                if (m == "theme") {
                    if (l.dtpl_defaults) {
                        return function (o) {
                            o(k());
                            l.dtpl_theme = true
                        }
                    }
                    return function (o) {
                        DISQUS.addJob(function () {
                            return l.dtpl_defaults
                        }, function () {
                            DISQUS.addBlocks(m)(o)
                        })
                    }
                }
            }
        }
    };
    a.renderBlock = function (k, m) {
        var l = DISQUS.blocks[k];
        if (typeof l == "undefined") {
            throw "Block " + k + " was not found!"
        }
        return DISQUS.sandbox.wrap(k, l, m)
    };
    a.events = {
        add: function (m, k, n) {
            DISQUS.assert(m.addEventListener || m.attachEvent, "Event registration not supported");
            if (m.addEventListener) {
                m.addEventListener(k, n, false);
                return n
            }
            var l = function () {
                var o = window.event;
                o.preventDefault = function () {
                    o.returnValue = false
                };
                return n(o)
            };
            m.attachEvent("on" + k, l);
            return l
        },
        remove: function (l, k, m) {
            if (l.removeEventListener) {
                l.removeEventListener(k, m, false)
            } else {
                if (l.detachEvent) {
                    l.detachEvent("on" + k, m)
                }
            }
        },
        debounce: function (n, m, o, l) {
            var k;

            function p(q) {
                if (k) {
                    clearTimeout(k)
                }
                k = setTimeout(function () {
                    o(q)
                }, l)
            }
            DISQUS.events.add(n, m, p)
        }
    };
    a.window = {
        getSize: function () {
            if (typeof d.innerWidth == "number") {
                return [d.innerWidth, d.innerHeight]
            } else {
                if (h.documentElement) {
                    return [h.documentElement.clientWidth || h.body.clientWidth, h.documentElement.clientHeight || h.body.clientHeight]
                } else {
                    return [-1, -1]
                }
            }
        },
        getScrollPosition: function () {
            var k = h.documentElement;
            if (k && (k.scrollTop || k.scrollWidth)) {
                return [k.scrollWidth, k.scrollTop || h.body.scrollTop]
            } else {
                return [h.body.scrollWidth, h.body.scrollTop]
            }
        }
    };
    return a
}(document, window));
(function () {
    var b = {},
        a;
    a = {
        translations: {},
        setGlobalContext: function (c) {
            DISQUS.extend(b, c)
        },
        get: function (c) {
            return a.translations[c] || c
        },
        interpolate: function (e, d) {
            var c = [d || {},
            b];

            function f(h) {
                for (var g = 0, j = c.length; g < j; g++) {
                    if (c[g][h] !== undefined) {
                        return String(c[g][h])
                    }
                }
                throw "Key " + h + "not found in context"
            }
            return e.replace(/%\(\w+\)s/g, function (g) {
                return f(g.slice(2, -2))
            })
        },
        pluralize: function (d, e, c) {
            return (d != 1) ? c || "s" : e || ""
        },
        trim: function (e) {
            e = e.replace(/^\s\s*/, "");
            var c = /\s/,
                d = e.length;
            while (c.test(e.charAt(--d))) {}
            return e.slice(0, d + 1)
        },
        capitalize: function (c) {
            return c.charAt(0).toUpperCase() + c.slice(1)
        }
    };
    a.Builder = function () {
        this.value = DISQUS.browser.ie ? [] : ""
    };
    a.Builder.prototype.put = (function () {
        return (DISQUS.browser.ie ?
        function (c) {
            this.value.push(c)
        } : function (c) {
            this.value += c
        })
    }());
    a.Builder.prototype.compile = function () {
        if (DISQUS.browser.ie) {
            this.value = this.value.join("")
        }
        return this.value
    };
    DISQUS.extend({
        strings: a
    })
}());
(function () {
    DISQUS.addJob = DISQUS.defer;
    DISQUS.getResourceURL = DISQUS.serialize;
    DISQUS.lang = {
        contains: DISQUS.contains,
        forEach: DISQUS.each,
        extend: DISQUS.extend,
        trim: DISQUS.strings.trim,
        partial: DISQUS.partial
    }
}());
(function (s, d) {
    var f = s.getElementsByTagName("head")[0] || s.getElementById("disqus_thread"),
        l = s.getElementsByTagName("meta"),
        k = false,
        c = ["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", "TkSuQmCC"],
        g = ["R0lGODlhEAALAPQAAP///z2LqeLt8dvp7u7090GNqz2LqV+fuJ/F1IW2ycrf51aatHWs", "waXJ14i4ys3h6FmctUCMqniuw+vz9eHs8fb5+meku+Tu8vT4+cfd5bbT3tbm7PH2+AAA", "AAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQu", "aW5mbwAh+QQJCwAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27if", "DgfkEYe04kDIDC5zrtYKRa2WQgAh+QQJCwAAACwAAAAAEAALAAAFJGBhGAVgnqhpHIeR", "vsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQJCwAAACwAAAAAEAALAAAFNiAgjoth", "LOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh", "+QQJCwAAACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+", "YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAkLAAAALAAAAAAQAAsAAAUyICCOZGme1rJY", "5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkECQsAAAAs", "AAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00k", "j5g0Al8tADY2y6C+4FIIACH5BAkLAAAALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpy", "HCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkECQsAAAAsAAAAABAACwAA", "BS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7", "AAAAAAAAAAAA"];

    function e(u, t) {
        return u.hasAttribute ? u.hasAttribute(t) : u.getAttribute(t) !== null
    }
    function i(u, t, v) {
        return e(u, t) && u.getAttribute(t) == v
    }
    function p() {
        var t;

        function y(z) {
            return !e(z, "src") && e(z, "name") && parseInt(z.getAttribute("name"), 10) && z.innerHTML === ""
        }
        for (var v = 0, w = l.length; v < w; v++) {
            if (i(l[v], "name", "generator") && i(l[v], "content", "blogger")) {
                t = s.getElementsByTagName("A");
                for (var u = 0, x = t.length; u < x; u++) {
                    if (y(t[u])) {
                        return t[u].getAttribute("name")
                    }
                }
            }
        }
        return null
    }
    function m(v) {
        for (var t = 0, u = v.length; t < u; t++) {
            if (v.charCodeAt(t) > 256) {
                return true
            }
        }
        return false
    }
    function q(t) {
        var v = 0,
            u = 0;
        if (!t.offsetParent) {
            return [0, 0]
        }
        do {
            v += t.offsetLeft;
            u += t.offsetTop;
            t = t.offsetParent
        } while (t);
        return [v, u]
    }
    function b(u) {
        var v = DISQUS.window.getScrollPosition()[1],
            t = v + DISQUS.window.getSize()[1];
        return ((u >= v) && (u <= t))
    }
    function r() {
        var u = d.location.href,
            y = d.location.hash,
            x = DsqLocal || {},
            w = p();
        DISQUS.extend(DISQUS.config, {
            container_id: disqus_container_id || "disqus_thread",
            page: {
                url: disqus_url || u,
                title: disqus_title || "",
                sort: disqus_sort || "",
                per_page: disqus_per_page || null,
                category_id: disqus_category_id || "",
                developer: +disqus_developer,
                identifier: disqus_identifier || ""
            },
            trackback_url: x.trackback_url || null,
            trackbacks: x.trackbacks || null
        });
        if (w) {
            DISQUS.config.page.blogger_id = w
        }
        if (!disqus_message || (DISQUS.browser.ie && m(disqus_message))) {
            DISQUS.config.message = ""
        } else {
            if (disqus_message.length > 400) {
                DISQUS.config.message = disqus_message.substring(0, disqus_message.indexOf(" ", 350))
            } else {
                DISQUS.config.message = disqus_message
            }
        }
        if (typeof disqus_require_moderation_s != "undefined") {
            DISQUS.config.page.require_mod_s = disqus_require_moderation_s
        }
        if (typeof disqus_remote_auth_s2 != "undefined") {
            DISQUS.config.page.remote_auth_s2 = disqus_remote_auth_s2
        }
        if (typeof disqus_author_s2 != "undefined") {
            DISQUS.config.page.author_s2 = disqus_author_s2
        }
        if (typeof disqus_per_page != "undefined") {
            DISQUS.config.page.per_page = disqus_per_page
        }
        if (typeof disqus_thread_slug != "undefined") {
            DISQUS.config.page.slug = disqus_thread_slug
        }
        var v;
        if (y) {
            v = y.match(/comment\-([0-9]+)/);
            if (v) {
                DISQUS.config.page.anchor_post_id = v[1]
            }
        }
        DISQUS.config.callback_params = disqus_callback_params || null;
        if (typeof disqus_callback == "function") {
            DISQUS.config.callbacks.afterRender.push(function () {
                disqus_callback(DISQUS.config.callback_params)
            })
        }
        if (typeof disqus_custom_strings == "object") {
            DISQUS.config.custom_strings = disqus_custom_strings
        }
        DISQUS.extend(DISQUS.config, {
            domain: disqus_domain || (disqus_dev ? "dev.disqus.org" : "disqus.com"),
            shortname: disqus_shortname || DISQUS.getShortname(),
            iframe_css: disqus_iframe_css || "",
            facebook_forum: disqus_facebook_forum || null,
            facebook_key: disqus_facebook_key || null,
            def_name: disqus_def_name,
            def_email: disqus_def_email,
            def_text: disqus_default_text || "",
            skip_auth: disqus_skip_auth || false
        });
        DISQUS.config.json_url = "//" + DISQUS.config.shortname + "." + DISQUS.config.domain + "/thread.js";
        if (typeof disqus_config == "function") {
            try {
                disqus_config.call(DISQUS.config)
            } catch (t) {}
        }
    }
    function j() {
        DISQUS.jsonData = {
            ready: false
        };
        DISQUS.require(DISQUS.config.json_url, DISQUS.config.page, true);
        var v = s.getElementById("dsq-content") || s.createElement("div");
        v.id = "dsq-content";
        v.style.display = "none";

        function u(A, x, z, C, B, y) {
            return "<" + ["img", 'width="' + A + '"', 'height="' + x + '"', 'alt="' + C + '"', 'src="data:image/' + z + ";base64," + B + '"', (y ? 'style="' + y + '"' : "")].join(" ") + ">"
        }
        var w = s.createElement("div");
        w.id = "dsq-content-stub";
        w.innerHTML = DISQUS.browser.ie6 ? "..." : u(71, 17, "png", "DISQUS", c.join("")) + u(16, 11, "gif", "...", g.join(""), "margin:0 0 3px 5px");
        var t = s.getElementById(DISQUS.config.container_id);
        t.appendChild(v);
        t.appendChild(w);
        DISQUS.ready(function () {
            DISQUS.initThread(function () {
                w.style.display = "none"
            })
        })
    }
    function n(B) {
        var w = s.getElementById("dsq-content");
        var v = DISQUS.settings.media_url + "/javascript/embed/dtpl/";
        var z = DISQUS.settings.media_url + "/build/system/";
        var u = DISQUS.settings.media_url + "/build/lang/";
        var t = DISQUS.jsonData.forum.template.css;
        var A = DISQUS.jsonData.forum.template.url;
        var x;
        (function () {
            var C = DISQUS.jsonData;
            DISQUS.strings.setGlobalContext({
                profile_url: C.urls.request_user_profile,
                disqus_url: C.settings.disqus_url,
                media_url: C.settings.media_url,
                request_username: C.request.username,
                request_display_username: C.request.display_username,
                forum_name: C.forum.name
            })
        })();
        DISQUS.callback(DISQUS.config.callbacks.preInit);
        if (DISQUS.browser.mobile && !DISQUS.jsonData.forum.mobile_theme_disabled) {
            t = DISQUS.jsonData.forum.template.mobile.css;
            A = DISQUS.jsonData.forum.template.mobile.url
        } else {
            if (DISQUS.config.template) {
                t = DISQUS.config.template.css;
                A = DISQUS.config.template.js
            }
        }
        if (!d.disqus_no_style && t) {
            DISQUS.requireStylesheet(t, {}, DISQUS.jsonData.settings.debug)
        }
        x = [A];
        var y = d.location.search;
        if (~y.indexOf("fbc_channel=1") || ~y.indexOf("fb_xd_fragment")) {
            DISQUS.require(A, {}, DISQUS.settings.debug, function () {
                DISQUS.registerActions();
                new DISQUS.comm.FacebookLoginBox()
            });
            return
        }
        if (typeof disqus_language != "undefined") {
            DISQUS.config.language = disqus_language
        }
        if (DISQUS.config.language) {
            if (DISQUS.config.language != "en") {
                x.push(u + DISQUS.config.language + ".js")
            }
        } else {
            if (DISQUS.jsonData.forum.language != "en") {
                x.push(u + DISQUS.jsonData.forum.language + ".js")
            }
        }
        DISQUS.comm.Default.create().setApiKey(DISQUS.jsonData.forum.apiKey);
        DISQUS.requireSet(x, DISQUS.jsonData.settings.debug, function () {
            if (DISQUS.config.custom_strings) {
                DISQUS.lang.extend(DISQUS.strings.translations, DISQUS.config.custom_strings)
            }
            if (DISQUS.config.def_text === "") {
                DISQUS.config.def_text = DISQUS.strings.get("Type your comment here.")
            }
            DISQUS.nodes.addClass(w, "clearfix");
            var C = w.parentNode;
            C.removeChild(w);
            w.innerHTML = DISQUS.renderBlock("thread");
            C.appendChild(w);
            DISQUS.callback(DISQUS.config.callbacks.onInit);
            DISQUS.registerActions();
            DISQUS.dtpl.actions.fire("thread.initialize");
            DISQUS.callback(DISQUS.config.callbacks.afterRender);
            DISQUS.nodes.container = DISQUS.nodes.get("#dsq-content");
            w.style.display = "block";
            B();
            var E, D;
            if (DISQUS.config.page.anchor_post_id) {
                DISQUS.nodes.scrollTo("#dsq-comment-" + DISQUS.config.page.anchor_post_id)
            }
            DISQUS.dtpl.actions.fire("thread.ready")
        })
    }
    function o() {
        for (var t = 0, u = l.length; t < u; t++) {
            if (l[t].getAttribute("name") == "viewport") {
                return true
            }
        }
        return false
    }
    DISQUS.extend({
        cache: {
            buttonsToRestore: [],
            popupProfileCache: {},
            popupStatusCache: {},
            toggledReplies: {},
            postSharing: {},
            realtime: {
                interval: null,
                ongoing_request: null,
                prev_script: null,
                last_checked: null,
                newPosts: []
            }
        },
        states: {
            edit: {},
            realtime: false,
            useLoginWindow: false,
            loginDisabled: false,
            metaViewport: o()
        },
        curPageId: "dsq-comments",
        frames: {},
        config: {
            template: null,
            callbacks: {
                preData: [],
                preInit: [],
                onInit: [],
                afterRender: [],
                onReady: [],
                onPaginate: [],
                onNewComment: [],
                preReset: []
            }
        },
        jsonData: null,
        isReady: false,
        getShortname: function () {
            function w(B) {
                var C = (B.getAttribute ? B.getAttribute("src") : B.src),
                    A = [/https?:\/\/(www\.)?disqus\.com\/forums\/([\w_\-]+)/i, /https?:\/\/(www\.)?([\w_\-]+)\.disqus\.com/i, /https?:\/\/(www\.)?dev\.disqus\.org\/forums\/([\w_\-]+)/i, /https?:\/\/(www\.)?([\w_\-]+)\.dev\.disqus\.org/i],
                    x = A.length;
                if (C) {
                    for (var z = 0; z < x; z++) {
                        var y = C.match(A[z]);
                        if (y && y.length && y.length == 3) {
                            return y[2]
                        }
                    }
                }
                return null
            }
            var t = s.getElementsByTagName("script");
            for (var v = t.length - 1; v >= 0; v--) {
                var u = w(t[v]);
                if (u !== null) {
                    return u
                }
            }
            return null
        },
        callback: function (y) {
            var v, x, t;
            var w = function (z) {
                if (d.console && console.log) {
                    console.log(z)
                }
            };
            if (arguments.length > 1) {
                t = Array.prototype.slice.call(arguments, 1)
            }
            for (v = 0; v < y.length; v++) {
                x = y[v];
                if (typeof x != "function") {
                    continue
                }
                try {
                    x.apply({}, t || [])
                } catch (u) {
                    if (DISQUS.settings.debug) {
                        throw u
                    }
                    if (u.toString().search("Dsq") > -1) {
                        w("WARNING: This page uses deprecated Disqus APIs. See blog.disqus.com for more info")
                    } else {
                        w(u)
                    }
                }
            }
        },
        reset: function (u) {
            var v = DISQUS.nodes.get("#" + DISQUS.config.container_id);
            u = u || {};
            DISQUS.comm.reset();
            DISQUS.jsonData = null;
            DISQUS.sandbox.invalidateGlobals();
            DISQUS.status = null;
            v.innerHTML = "";
            DISQUS.callback(DISQUS.config.callbacks.preReset);
            DISQUS.each(DISQUS.config.callbacks, function (x, w) {
                DISQUS.config.callbacks[w] = []
            });
            if (!u.reload) {
                return
            }
            r();
            if (u.config) {
                try {
                    u.config.call(DISQUS.config)
                } catch (t) {}
            }
            j()
        },
        reload: function (t) {
            DISQUS.require(DISQUS.config.json_url, DISQUS.config.page, true, function () {
                k = true;
                if (typeof t == "function") {
                    t()
                }
            })
        },
        redraw: function (u) {
            var t;
            if (k || u) {
                DISQUS.sandbox.invalidateGlobals();
                t = DISQUS.nodes.get("#dsq-content");
                t.innerHTML = DISQUS.renderBlock("thread");
                DISQUS.frames = [];
                DISQUS.dtpl.actions.fire("thread.initialize");
                k = false
            }
        },
        initThread: function (w) {
            var t, y, z, u, v;

            function A(C) {
                var D = d.onload;
                if (typeof d.onload != "function") {
                    d.onload = C
                } else {
                    d.onload = function () {
                        if (D) {
                            D()
                        }
                        C()
                    }
                }
            }
            function B() {
                var C, G, D;
                if (!DISQUS.isReady) {
                    if (!v) {
                        v = d.setInterval(B, 500)
                    }
                    return
                }
                if (v) {
                    clearInterval(v)
                }
                C = s.getElementById(disqus_container_id);
                G = s.getElementsByTagName("iframe");
                D = s.getElementById("dsq-content");
                if (D) {
                    for (var E = 0, F = G.length; E < F; E++) {
                        G[E].style.width = D.offsetWidth
                    }
                }
            }
            if (DISQUS.browser.ie && DISQUS.config.frame_theme !== "cnn2") {
                A(B)
            }
            z = s.createElement("style");
            f.appendChild(z);
            DISQUS.cache.inlineStylesheet = z.sheet;
            if (!DISQUS.cache.inlineStylesheet) {
                DISQUS.cache.inlineStylesheet = s.styleSheets[s.styleSheets.length - 1]
            }
            if (DISQUS.browser.ie6 || DISQUS.browser.ie7) {
                u = {
                    b: (DISQUS.browser.ie6 ? "ie6" : "ie7")
                }
            }
            DISQUS.requireStylesheet("http://" + DISQUS.config.domain + "/forums/" + DISQUS.config.shortname + "/styles.css", u);
            DISQUS.callback(DISQUS.config.callbacks.preData);
            y = s.getElementById("dsq-content") || s.createElement("div");
            y.id = "dsq-content";
            y.style.display = "none";
            t = s.getElementById(DISQUS.config.container_id);
            t.appendChild(y);
            DISQUS.container = s.getElementById("dsq-content");
            try {
                if (DISQUS.browser.ie6) {
                    s.execCommand("BackgroundImageCache", false, true)
                }
            } catch (x) {}
            if (DISQUS.jsonData === null) {
                DISQUS.require(DISQUS.config.json_url, DISQUS.config.page, true, function () {
                    n(w)
                })
            } else {
                DISQUS.addJob(function () {
                    return DISQUS.jsonData && DISQUS.jsonData.ready
                }, function () {
                    n(w)
                })
            }
        }
    });
    r();
    j();
    (function () {
        var u = document.getElementById(DISQUS.config.container_id),
            t = q(u)[1];

        function v() {
            if (u && b(t)) {
                DISQUS.trigger("disqus.viewed")
            }
        }
        v();
        DISQUS.events.debounce(window, "scroll", v, 250)
    }());
    DISQUS.config.callbacks.onReady.push(function () {
        var u = s.getElementById("dsq-reply") || s.getElementById("dsq-new-post"),
            t = u ? DISQUS.nodes.getPosition(u)[1] + u.offsetHeight : null,
            x = s.getElementById("dsq-comments"),
            w = DISQUS.nodes.getPosition(x)[1] + x.offsetHeight;

        function v() {
            if (t && b(t)) {
                DISQUS.trigger("comments.reply.viewed")
            }
            if (w && b(w)) {
                DISQUS.trigger("comments.viewed")
            }
        }
        v();
        DISQUS.events.debounce(window, "scroll", v, 250)
    });

    function h(t) {
        return Date.UTC(t.getUTCFullYear(), t.getUTCMonth(), t.getUTCDate(), t.getUTCHours(), t.getUTCMinutes(), t.getUTCSeconds(), t.getUTCMilliseconds())
    }
    var a = h(new Date());
    DISQUS.config.callbacks.onReady.push(function () {
        var u = DISQUS.comm.Default.recover(),
            t = h(new Date());
        u.log("load:start", a);
        u.log("load:length", t - a)
    });
    DISQUS.config.callbacks.afterRender.push(function () {
        var u = DISQUS.comm.Default.recover(),
            t = DISQUS.jsonData;
        if (true || t.context.switches.sigma) {
            u.enable(t.context.sigma_chance)
        }
        if (t.forum.id) {
            u.log("info:forum_id", t.forum.id)
        }
        if (t.thread.id) {
            u.log("info:thread_id", t.thread.id)
        }
        if (t.request.user_type) {
            u.log("info:user_type", t.request.user_type)
        }
        if (t.request.user_id) {
            u.log("info:user_id", t.request.user_id)
        }
    });
    DISQUS.bind("comments.viewed", function () {
        var t = DISQUS.comm.Default.recover();
        t.log("viewed:comments", 1);
        DISQUS.unbind("comments.viewed", this.guid)
    });
    DISQUS.bind("comments.reply.viewed", function () {
        var t = DISQUS.comm.Default.recover();
        t.log("viewed:comment_box", 1);
        DISQUS.unbind("comments.reply.viewed", this.guid)
    })
})(document, window);