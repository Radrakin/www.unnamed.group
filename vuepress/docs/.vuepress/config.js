const fs = require("fs");

module.exports = {
  title: "UAG Handbook",
  description: "A handy tome for the scholarly contractor",
  base: "/handbook/",
  dest: "public",
  head: [
    [
      "link",
      {
        rel: "icon",
        href: "/uagLogo.png"
      }
    ]
  ],
  serviceWorker: true,
  themeConfig: {
    sidebar: {
      "/" : [
        getSidebar("fundamentals","0: Fundamentals", [
          "unit-introduction",
          "code-of-conduct",
          "first-time-setup",
        ]),
        getSidebar("infantryman-basics","1: Infantryman Basics", [
          "the-fireteam",
          "making-a-loadout",
        //   "movement-techniques",
        //   "situational-awareness",
        //   "orienteering",
        //   "basic-marksmanship",
        //   "grenades",
        //   "basic-medical-procedures",
        //   "communication",
        //   "basic-driving-skills",
        //   "military-operations-in-urban-terrain",
        //   "individual-initiative",
        //   "fighting-at-night",
        ]),
        // getSidebar("infantryman-specialisations","2: Infantryman Specialisations", [
        //   "bitch boy",
        //   "pointman",
        //   "marksman",
        //   "autorifleman",
        //   "grenadier",
        //   "light anti-tank",
        //   "corpsman",
        // ]),
        // getSidebar("advanced-techniques","3: Advanced Techniques", [
        //   "machinegun-specialist",
        //   "anti-tank-specialist",
        //   "anti-air-specialist",
        //   "advanced-medical-procedures",
        //   "armoured-combat",
        //   "crew-served-weapons",
        //   "engineers",
        //   "airborne-infantry",
        //   "reconnaissance",
        //   "artillery",
        //   "survival-evasion-resistance-escape",
        //   "special-operations",
        //   "guerilla-warfare",
        //   "marine-operations",
        //   "divers",
        // ]),
        // getSidebar("aviation","4: Aviation", [
        //   "text",
        // ]),
        // getSidebar("leadership","5: Leadership", [
        //   "unit-organisation",
        //   "fireteam-leader",
        //   "section-commander",
        //   "crossroads",
        //   "mission-preparation",
        //   "advanced-reporting",
        //   "firemission-coordination",
        //   "firefight-theory",
        //   "assault-theory",
        //   "defence-theory",
        //   "ambush-tactics",
        //   "combat-egress",
        //   "convoy-operations",
        //   "combined-arms",
        //   "common-leadership-problems",
        // ]),
        // getSidebar("staff","6: Staff"),
        // getSidebar("resources","Resources")
      ]
    },
    sidebarDepth: 2,
    displayAllHeaders: false,
    activeHeaderLinks: true,
    lastUpdated: true,
    nav: [
      {
        text: "Important Links",
        items: [
          {
            text: "Code of Conduct",
            link: "/fundamentals/code-of-conduct"
          },
          {
            text: "First Time Setup",
            link: "/fundamentals/first-time-setup"
          }
        ]
      }
    ],
    serviceWorker: {
      updatePopup: {
        message: "This page just got updated!",
        buttonText: "Refresh?"
      }
    },
    repo: "https://gitlab.com/zeue-oss/unnamed.group/www/tree/master/vuepress",
    repoLabel: "Contribute!",
    docsDir: "docs",
    editLinks: true,
    editLinkText: "Help us improve this page!",
    algolia: {
      apiKey: "ad618428dcffec7d35c9f77b544b1d9a",
      indexName: "uagpmc"
    },
    searchPlaceholder: 'Search...'
  },
  markdown: {
    lineNumbers: true
  },
  plugins: ["@vuepress/nprogress", "@vuepress/back-to-top", require("./darkreader.js")]
};

function getSidebar(directory, title, order) {
  let _fileScan = fs.readdirSync(__dirname + "/../" + directory);

  if (order) {
    order.reverse();
    for (let i = 0; i < order.length; i++) {
      _fileScan
        .unshift(order[i] + ".md");

      //create temporary var to swap indexes 0 and 1, why isn't there just a swap() method?
      let temp = _fileScan[1];
      _fileScan[1] = _fileScan[0];
      _fileScan[0] = temp;
    }
    //fancy new ES6 thing, map all elements of _fileScan to a new "set" which is an array without duplicates!
    _fileScan = [... new Set(_fileScan)];
  }

  let _children = _fileScan.map(
      function (_x) {
        let returned = directory + "/" + _x.replace(".md","");

        if (returned.includes("README")) {
          returned = returned.replace("README","")
        }

        return "/" + returned;
      }
    );
  let _sidebarConfig = {
    title: title,
    collapsable: true,
    children: _children
  }
  return _sidebarConfig;
}
