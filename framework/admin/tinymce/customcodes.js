/// Combo de Shortcodes
/*
var my_shortcodes = ['[haha]','[hehe]'];
(function () {
    tinymce.create('tinymce.plugins.drop', {
        init: function (ed, url) {},
        createControl: function (n, cm) {

            if (n == 'drop') {
                var mlb = cm.createListBox('drop', {
                    title: 'drop',
                    //image: url + '/logo.png',
                    onselect: function (v) {
                        if (tinyMCE.activeEditor.selection.getContent() == '') {
                            tinyMCE.activeEditor.selection.setContent(v)
                        }
                    }
                });

                for (var i in my_shortcodes)
                    mlb.add(my_shortcodes[i], my_shortcodes[i]);

                return mlb;
            }
            return null;
        }


    });
    tinymce.PluginManager.add('drop', tinymce.plugins.drop);
})();
*/


(function () {
    tinymce.create('tinymce.plugins.drop', {
        init: function (ed, url) { miurl = url; },
        createControl: function (n, cm) {

            if (n == 'drop') {
                var mlb = cm.createMenuButton('drop', {
                    title: 'drop',
                    icons : false,
                    image: miurl + '/logo.png'                  
                });

                mlb.onRenderMenu.add(function(c, m) {
                    var sub;
                    m.add({title : 'Blockquote', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[blockquote align="left" color="#444" bgcolor="#fff"]your text here[/blockquote]');
                    }});
                    m.add({title : 'Divider', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[divider weight="1" color="#333" style="dotted"]');
                    }});
                    m.add({title : 'Margin', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[margin size="20"]');
                    }});
                    m.add({title : 'Highlight', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[highlight color="#fff" bgcolor="#ff0000"] your text here [/highlight]');
                    }});
                    m.add({title : 'Buttons', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[button title="My button" link="#" size="3" style="2"]');
                    }});
                    m.add({title : 'Alerts', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[alert style="1"]My text goes here...[/alert]');
                    }});
                    m.add({title : 'Progress Bar', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[pbar size="75" style="1"]');
                    }});                                                                                                                                                                                                                     
                    m.add({title : 'Tabs', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[tabs][tab title="title 1"]Your content 1...[/tab][tab title="title 2"]Your content 2...[/tab][/tabs]');
                    }});
                    m.add({title : 'Toggle', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[toggle_content title="Title"]Your content goes here...[/toggle_content]');
                    }});     
                    
                                     
                    m.add({title : 'Video Youtube', onclick : function() {
                        tinyMCE.activeEditor.execCommand('mceInsertContent', false, '[youtube id="video id" width="600" height="450"]');
                    }});
                });

                return mlb;
            }
            return null;
        }


    });
    tinymce.PluginManager.add('drop', tinymce.plugins.drop);
})();


//////////////////////////////////////////////////////////////////
// Add One_half button
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.one_half', {
            init: function (ed, url) {
                ed.addButton(
                    'one_half', {
                        title: 'Add a one_half column',
                        image: url + '/btn_1.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[one_half]your text here[/one_half]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'one_half', tinymce.plugins
        .one_half);
})();
//////////////////////////////////////////////////////////////////
// Add one_third button
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.one_third', {
            init: function (ed, url) {
                ed.addButton(
                    'one_third', {
                        title: 'Add a one_third column',
                        image: url + '/btn_2.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[one_third]your text here[/one_third]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'one_third', tinymce.plugins
        .one_third);
})();
//////////////////////////////////////////////////////////////////
// Add one_fourth button
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.one_fourth', {
            init: function (ed, url) {
                ed.addButton(
                    'one_fourth', {
                        title: 'Add a one_fourth column',
                        image: url + '/btn_3.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[one_fourth]your text here[/one_fourth]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'one_fourth', tinymce.plugins
        .one_fourth);
})();
//////////////////////////////////////////////////////////////////
// Add one_fifth button
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.one_fifth', {
            init: function (ed, url) {
                ed.addButton(
                    'one_fifth', {
                        title: 'Add a one_fifth column',
                        image: url + '/btn_4.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[one_fifth]your text here[/one_fifth]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'one_fifth', tinymce.plugins
        .one_fifth);
})();
//////////////////////////////////////////////////////////////////
// Add two_third button
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.two_third', {
            init: function (ed, url) {
                ed.addButton(
                    'two_third', {
                        title: 'Add a two_third column',
                        image: url + '/btn_5.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[two_third]your text here[/two_third]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'two_third', tinymce.plugins
        .two_third);
})();

//////////////////////////////////////////////////////////////////
// Add three_fourth button
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.three_fourth', {
            init: function (ed, url) {
                ed.addButton(
                    'three_fourth', {
                        title: 'Add a three_fourth column',
                        image: url + '/btn_7.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[three_fourth]your text here[/three_fourth]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'three_fourth', tinymce.plugins
        .three_fourth);
})();

//////////////////////////////////////////////////////////////////
// Blockquote
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.quote', {
            init: function (ed, url) {
                ed.addButton(
                    'quote', {
                        title: 'Add a blockquote',
                        image: url + '/btn_quotes.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[blockquote style="style1"]your text here[/quote]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'quote', tinymce.plugins
        .quote);
})();


//////////////////////////////////////////////////////////////////
// Toggle
//////////////////////////////////////////////////////////////////
(function () {
    tinymce.create(
        'tinymce.plugins.toggle', {
            init: function (ed, url) {
                ed.addButton(
                    'toggle', {
                        title: 'Add toggle',
                        image: url + '/btn_toggle.png',
                        onclick: function () {
                            ed.selection
                                .setContent(
                                    '[toggle_content title="Title"]Your content goes here...[/toggle_content]'
                            );
                        }
                    });
            },
            createControl: function (
                n, cm) {
                return null;
            },
        });
    tinymce.PluginManager.add(
        'toggle', tinymce.plugins
        .toggle);
})();