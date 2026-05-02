const title = 'Maternal and Child Health';
try {
    const re = new RegExp(`^[\\s\\S]{0,300}?<p[^>]*>\\s*(?:<span[^>]*>|<strong[^>]*>|<b>|<i>)?\\s*${title.replace(/[.*+?^\\${}()|[\\]\\\\]/g, '\\\\$&')}\\s*(?:</(?:span|strong|b|i)>)?\\s*</p>`, 'i');
    console.log("Regex 1 is valid", re);
} catch (e) {
    console.error("Regex 1 error", e);
}

const excerpt = 'Pregnancy';
try {
    const re2 = new RegExp(`^[\\s\\S]{0,300}?(?:<p[^>]*>|<div[^>]*>)\\s*(?:<span[^>]*>|<strong[^>]*>|<b>|<i>)?\\s*${excerpt ? excerpt.substring(0, 15).replace(/[.*+?^\\${}()|[\\]\\\\]/g, '\\\\$&') : 'XYZXYZ'}.*?(?:</p>|</div>)`, 'i');
    console.log("Regex 2 is valid", re2);
} catch (e) {
    console.error("Regex 2 error", e);
}
