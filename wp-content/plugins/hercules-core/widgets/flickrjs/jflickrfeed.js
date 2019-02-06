(function(e) {
    e.fn.jflickrfeed = function(t, n) {
        t = e.extend(true, {
            flickrbase: "http://api.flickr.com/services/feeds/",
            feedapi: "photos_public.gne",
            limit: 20,
            qstrings: {
                lang: "en-us",
                format: "json",
                jsoncallback: "?"
            },
            cleanDescription: true,
            useTemplate: true,
            itemTemplate: "",
            itemCallback: function() {}
        }, t);
        var r = t.flickrbase + t.feedapi + "?";
        var i = true;
        for (var s in t.qstrings) {
            if (!i) r += "&";
            r += s + "=" + t.qstrings[s];
            i = false
        }
        return e(this).each(function() {
            var i = e(this);
            var s = this;
            e.getJSON(r, function(r) {
                e.each(r.items, function(e, n) {
                    if (e < t.limit) {
                        if (t.cleanDescription) {
                            var r = /<p>(.*?)<\/p>/g;
                            var o = n.description;
                            if (r.test(o)) {
                                n.description = o.match(r)[2];
                                if (n.description != undefined) n.description = n.description.replace("<p>", "").replace("</p>", "")
                            }
                        }
                        n["image_s"] = n.media.m.replace("_m", "_s");
                        n["image_t"] = n.media.m.replace("_m", "_t");
                        n["image_m"] = n.media.m.replace("_m", "_m");
                        n["image"] = n.media.m.replace("_m", "");
                        n["image_b"] = n.media.m.replace("_m", "_b");
                        n["image_q"] = n.media.m.replace("_m", "_q");
                        delete n.media;
                        if (t.useTemplate) {
                            var u = t.itemTemplate;
                            for (var a in n) {
                                var f = new RegExp("{{" + a + "}}", "g");
                                u = u.replace(f, n[a])
                            }
                            i.append(u)
                        }
                        t.itemCallback.call(s, n)
                    }
                });
                if (e.isFunction(n)) {
                    n.call(s, r)
                }
            })
        })
    }
})(jQuery)