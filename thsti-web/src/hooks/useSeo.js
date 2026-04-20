import { useEffect } from 'react';

/**
 * A custom React hook to dynamically update the Document Title and Meta tags.
 * This ensures search engines and social media scrapers (like WhatsApp/Twitter)
 * read the correct SEO data for the current dynamic page.
 */
export const useSeo = ({ title, metaTitle, metaDescription, ogImage }) => {
    useEffect(() => {
        // 1. Update the Browser Tab Title
        const finalTitle = metaTitle || title;
        if (finalTitle) {
            document.title = `${finalTitle} | Translational Health Science and Technology Institute`;
        } else {
            document.title = 'Translational Health Science and Technology Institute';
        }

        // Helper function to safely update or append meta tags to the <head>
        const setMetaTag = (selector, attribute, content) => {
            if (!content) return;
            let element = document.querySelector(selector);
            if (!element) {
                element = document.createElement('meta');
                element.setAttribute(attribute.name, attribute.value);
                document.head.appendChild(element);
            }
            element.setAttribute('content', content);
        };

        // 2. Standard Search Engine Description (Google)
        setMetaTag('meta[name="description"]', { name: 'name', value: 'description' }, metaDescription);

        // 3. OpenGraph Tags (Facebook, LinkedIn, Slack, WhatsApp previews)
        if (finalTitle) {
            setMetaTag('meta[property="og:title"]', { name: 'property', value: 'og:title' }, finalTitle);
        }
        setMetaTag('meta[property="og:description"]', { name: 'property', value: 'og:description' }, metaDescription);
        
        if (ogImage) {
            setMetaTag('meta[property="og:image"]', { name: 'property', value: 'og:image' }, ogImage);
        }

    }, [title, metaTitle, metaDescription, ogImage]);
};
