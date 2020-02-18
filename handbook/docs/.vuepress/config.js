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
      "/": [
        getSidebar("fundamentals", "Fundamentals", [
          "unit-introduction",
          "code-of-conduct",
          "first-time-setup"
        ]),
        getSidebar("basics", "The Basics", ["formations"]),
        // getSidebar("advanced", "Advanced Topics", ["orbats"]),
        // getSidebar("staff", "Staff", [""]),
        getSidebar("resources", "Resources", ["orbats"])
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
          },
          {
            text: "ORBATs",
            link: "/resources/orbats"
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
    repo: "https://github.com/zeue/www.unnamed.group/tree/master/handbook",
    repoLabel: "Contribute!",
    docsDir: "docs",
    editLinks: true,
    editLinkText: "Help us improve this page!",
    algolia: {
      apiKey: "ad618428dcffec7d35c9f77b544b1d9a",
      indexName: "uagpmc"
    },
    searchPlaceholder: "Search..."
  },
  markdown: {
    toc: { includeLevel: [1, 2] },
    lineNumbers: true,
    extendMarkdown: md => {
      md.use(require("markdown-it-task-lists"), { enabled: true });
    }
  },
  plugins: [
    require("./darkreader.js"),
    require("./formationMaker.js"),
    [
      "vuepress-plugin-medium-zoom",
      {
        selector: "img",
        delay: 1000,
        options: {
          margin: 24,
          background: "#333",
          scrollOffset: 0
        }
      }
    ],
    "flowchart",
    "vuepress-plugin-export",
    "img-lazy"
  ]
};

function getSidebar(directory, title, order) {
  let _fileScan = fs.readdirSync(__dirname + "/../" + directory);

  if (order) {
    order.reverse();
    for (let i = 0; i < order.length; i++) {
      _fileScan.unshift(order[i] + ".md");

      //create temporary var to swap indexes 0 and 1, why isn't there just a swap() method?
      let temp = _fileScan[1];
      _fileScan[1] = _fileScan[0];
      _fileScan[0] = temp;
    }
    //fancy new ES6 thing, map all elements of _fileScan to a new "set" which is an array without duplicates!
    _fileScan = [...new Set(_fileScan)];
  }

  let _children = _fileScan.map(function(_x) {
    let returned = directory + "/" + _x.replace(".md", "");

    if (returned.includes("README")) {
      returned = returned.replace("README", "");
    }

    return "/" + returned;
  });
  let _sidebarConfig = {
    title: title,
    collapsable: true,
    children: _children
  };
  return _sidebarConfig;
}
