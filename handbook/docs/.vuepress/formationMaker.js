module.exports = () => {
  return {
    enhanceAppFiles() {
      return {
        name: "formationMaker",
        content: `export default () => {
          if (typeof window !== 'undefined') {
            window.createFormation = (elementId, options) => {
              let container = new Two({
                      type: Two.Types.canvas,
                      width: options.width,
                      height: options.height
                  }).appendTo(document.getElementById(elementId));

              let numberOfRows = options.formation.length,
                  numberOfColumns = options.formation.sort((a, b) => {return b.length - a.length})[0].length,
                  eachRowHeight = options.height / numberOfRows,
                  eachColumnWidth = options.width / numberOfColumns;
              
              options.formation.forEach((row, rowNumber) => {
                  row.forEach((cell, columnNumber) => {
                      if (cell === 0) {return;}

                      let cellContents = container.makeRoundedRectangle(
                              (eachColumnWidth * columnNumber) + (eachColumnWidth / 2),
                              (eachRowHeight * rowNumber) + (eachRowHeight / 2),
                              eachColumnWidth * 0.9,
                              eachRowHeight * 0.9,
                              [eachColumnWidth, eachRowHeight].sort((a, b) => {return a - b})[0] / 2
                          );

                      cellContents.fill = '#FF8000';
                      cellContents.stroke = 'orangered';
                      cellContents.linewidth = 3;

                      container.update();
                  });
              });
            };
          };
         };`
      };
    }
  };
};
