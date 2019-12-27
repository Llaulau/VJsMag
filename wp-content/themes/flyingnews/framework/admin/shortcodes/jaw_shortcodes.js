// JavaScript Document
(function() {
    var thm;
    tinymce.create('tinymce.plugins.jaw_shortcodes', {
        init : function(ed, url) {
            thm = url;
            ed.addCommand("jaw_shortcodes", function ( a, params )
            {
                var code = params.identifier;
				
                // load thickbox
                tb_show("Insert JaW Shortcode", url + "/jaw_shortcodes_generator.php?code=" + code + "&width=" + 670);
            });
            
        },
        createControl: function(n, cm) {
            switch (n) {
                case 'jaw_shortcodes':
                    var c = cm.createMenuButton('jaw_shortcodes', {
                        title : 'Insert Shortcode',
                        image : thm + '/assets/img/shortcodes-icon.gif',
                        icons : false
                    });

                    c.onRenderMenu.add(function(c, m) {
                        var sub;
                        
                        /* START COLUMNS **************************************/
                        sub = m.addMenu({
                            title : 'Columns'
                        });
                        
                        sub.add({
                            title : 'One Half', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_half]' + tinymce.activeEditor.selection.getContent() + '[/one_half]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Half Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_half_last]' + tinymce.activeEditor.selection.getContent() + '[/one_half_last]');
                            }
                        });

                        sub.add({
                            title : 'One Third', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_third]' + tinymce.activeEditor.selection.getContent() + '[/one_third]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Third Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_third_last]' + tinymce.activeEditor.selection.getContent() + '[/one_third_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'Two Third', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[two_third]' + tinymce.activeEditor.selection.getContent() + '[/two_third]');
                            }
                        });
                        
                        sub.add({
                            title : 'Two Third Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[two_third_last]' + tinymce.activeEditor.selection.getContent() + '[/two_third_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Fourth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_fourth]' + tinymce.activeEditor.selection.getContent() + '[/one_fourth]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Fourth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_fourth_last]' + tinymce.activeEditor.selection.getContent() + '[/one_fourth_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'Three Fourth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[three_fourth]' + tinymce.activeEditor.selection.getContent() + '[/three_fourth]');
                            }
                        });
                        
                        sub.add({
                            title : 'Three Fourth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[three_fourth_last]' + tinymce.activeEditor.selection.getContent() + '[/three_fourth_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Fifth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_fifth]' + tinymce.activeEditor.selection.getContent() + '[/one_fifth]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Fifth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_fifth_last]' + tinymce.activeEditor.selection.getContent() + '[/one_fifth_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'Two Fifth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[two_fifth]' + tinymce.activeEditor.selection.getContent() + '[/two_fifth]');
                            }
                        });
                        
                        sub.add({
                            title : 'Two Fifth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[two_fifth_last]' + tinymce.activeEditor.selection.getContent() + '[/two_fifth_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'Three Fifth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[three_fifth]' + tinymce.activeEditor.selection.getContent() + '[/three_fifth]');
                            }
                        });
                        
                        sub.add({
                            title : 'Three Fifth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[three_fifth_last]' + tinymce.activeEditor.selection.getContent() + '[/three_fifth_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'Four Fifth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[four_fifth]' + tinymce.activeEditor.selection.getContent() + '[/four_fifth]');
                            }
                        });
                        
                        sub.add({
                            title : 'Four Fifth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[four_fifth_last]' + tinymce.activeEditor.selection.getContent() + '[/four_fifth_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Sixth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_sixth]' + tinymce.activeEditor.selection.getContent() + '[/one_sixth]');
                            }
                        });
                        
                        sub.add({
                            title : 'One Sixth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[one_sixth_last]' + tinymce.activeEditor.selection.getContent() + '[/one_sixth_last]');
                            }
                        });
                        
                        sub.add({
                            title : 'Five Sixth', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[five_sixth]' + tinymce.activeEditor.selection.getContent() + '[/five_sixth]');
                            }
                        });
                        
                        sub.add({
                            title : 'Five Sixth Last', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[five_sixth_last]' + tinymce.activeEditor.selection.getContent() + '[/five_sixth_last]');
                            }
                        });
                        
                        /* END COLUMNS ****************************************/
                        
                        /* LAYOUTS ********************************************/
                        sub = m.addMenu({
                            title : 'Layouts'
                        });
                        
                        sub.add({
                            title : 'Two Columns', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_two_column'
                                })
                            }
                        });

                        sub.add({
                            title : 'Three Colums', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_three_column'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Four Colums', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_four_column'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Five Colums', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_five_column'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Six Colums', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_six_column'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Third - Two Third', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_third_two_third'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Two Third - One Third', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_two_third_one_third'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Fourth - Three Fourth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_fourth_three_fourth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Three Fourth - One Fourth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_three_fourth_one_fourth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Fourth - One Fourth - One Half', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_fourth_one_fourth_one_half'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Fourth - One Half - One Fourth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_fourth_one_half_one_fourth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Half - One Fourth - One Fourth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_half_one_fourth_one_fourth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Four Fifth - One Fifth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_four_fifth_one_fifth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Fifth - Four Fifth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_fifth_four_fifth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Two Fifth - Three Fifth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_two_fifth_three_fifth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Three Fifth - Two Fifth', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_three_fifth_two_fifth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Six - Five Six', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_sixth_five_sixth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Five Six - One Six', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_five_sixth_one_sixth'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'One Sixth - One Sixth - One Sixth - One Half', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'l_one_sixth_one_sixth_one_sixth_one_half'
                                })
                            }
                        });
                        
                        /* END LAYOUTS ****************************************/
                        
                        /* START TYPOGRAPHY ***********************************/
                        sub = m.addMenu({
                            title : 'Typography'
                        });
                        
                        var subSub = sub.addMenu({
                            title: 'Headlines'
                        });
                        
                        subSub.add({
                            title : 'h1', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[h1]' + tinymce.activeEditor.selection.getContent() + '[/h1]');
                            }
                        });
                        
                        subSub.add({
                            title : 'h2', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[h2]' + tinymce.activeEditor.selection.getContent() + '[/h2]');
                            }
                        });   
                        subSub.add({
                            title : 'h3', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[h3]' + tinymce.activeEditor.selection.getContent() + '[/h3]');
                            }
                        });    
                        subSub.add({
                            title : 'h4', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[h4]' + tinymce.activeEditor.selection.getContent() + '[/h4]');
                            }
                        });    
                        subSub.add({
                            title : 'h5', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[h5]' + tinymce.activeEditor.selection.getContent() + '[/h5]');
                            }
                        });    
                        subSub.add({
                            title : 'h6', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[h6]' + tinymce.activeEditor.selection.getContent() + '[/h6]');
                            }
                        });    
                        
                        sub.add({
                            title : 'Blockquote', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'blockquote'
                                })
                            }
                        });

                        sub.add({
                            title : 'Button', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'buttons'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Highlight', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'highlight'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Notices', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'notices'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Pre', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'pre'
                                })
                            }
                        });  
                        
                        sub.add({
                            title : 'Code', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'code'
                                })
                            }
                        });  
                        /* END TYPOGRAPHY *************************************/
                        
                        /* START DIVIDERS *************************************/
                        sub = m.addMenu({
                            title : 'Dividers'
                        });
                        
                        sub.add({
                            title : 'Divider To Top', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[divider_to_top]');
                            }
                        });
                        
                        sub.add({
                            title : 'Divider Line', 
                            onclick : function() {
                                tinymce.activeEditor.selection.setContent('[divider_line]');
                            }
                        });
                        
                        sub.add({
                            title : 'Custom Divider Line', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'adv_divider'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Custom Divider To Top', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'adv_divider_to_top'
                                })
                            }
                        });
                        
                        /* END DIVIDERS ***************************************/
                        
                        /* FEATURES *******************************************/
                        sub = m.addMenu({
                            title : 'Features'
                        });
                        
                        sub.add({
                            title : 'Iframe', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'iframe'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Google Map', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'google_map'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Tabs', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'tabs'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Accordion', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'accordion'
                                })
                            }
                        });
                        
                        sub.add({
                            title : 'Toggle', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'toggle'
                                })
                            }
                        });                        
                        /* END FEATURES ***************************************/
                        
                        /* MEDIA **********************************************/
                        sub = m.addMenu({
                            title : 'Media'
                        });
                        
                        var subSub = sub.addMenu({
                            title: 'Video'
                        });
                        
                        subSub.add({
                            title : 'Youtube', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'v_youtube'
                                })
                            }
                        });
                        
                        subSub.add({
                            title : 'Vimeo', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'v_vimeo'
                                })
                            }
                        });                        
                        /* END MEDIA ******************************************/
                        m.add({
                            title : 'Contact Form', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'contact_form'
                                })
                            }
                        });
                        
                        m.add({
                            title : 'Portfolio', 
                            onclick : function() {
                                tinyMCE.activeEditor.execCommand("jaw_shortcodes", false, {
                                    title: title,
                                    identifier: 'portfolio'
                                })
                            }
                        });
                    });

                    // Return the new menu button instance
                    return c;
            }

            return null;
        },
        getInfo: function () {
            return {
                longname: 'JaW Shortcodes',
                author: 'JaW Templates',
                authorurl: 'http://themeforest.net/user/jawtemplates/',
                infourl: 'http://www.jawtemplates.com/',
                version: "1.0"
            }
        }
    });
    tinymce.PluginManager.add('jaw_shortcodes', tinymce.plugins.jaw_shortcodes);
})();