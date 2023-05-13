/**
 * J'ai créé un tableau multidimensionnel fictif
 *  Enfin j'avais initialement remplacé et complété la boucle avec la methode reduce 
 * "return articles.reduce(function(acc, article) {
        return acc + Math.min(article.length, kudos)
    }, 0);"
 * Mais cela n'aurait pas eu d'intérêt par rapport au sujet du test à savoir les variables shadow et les portées des différentes déclarations
 * Du coup j'ai laissé les variables et modifié les déclarations en let qui est plus restrictif et moins source d'erreur.
 *
 * @type {number[][]}
 */
const articleList = [[1, 2, 3, 4], [1, 1, 5, 7, 8, 5, 2, 1, 4], [8, 7, 8, 7], [1],]; // In a real app this list would be full of articles.
let kudos = 5;

/**
 * 
 * @param {array} articles 
 * @param {number} maxKudos 
 * @returns 
 */
function calculateTotalKudos(articles, maxKudos) {
    let kudos = 0;

    for (let article of articles) {
        kudos += Math.min(article.length, maxKudos);
    }

    return kudos;
}

document.write(`
    <p>Maximum kudos you can give to an article: ${kudos}</p>
    <p>Total Kudos already given across all articles: ${calculateTotalKudos(articleList, kudos)}</p>
`);
