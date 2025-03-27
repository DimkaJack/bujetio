export function getContrastColor(hex) {
    // if (!hex) return '#000000';
    //
    // // Remove "#" if present
    // hex = hex.replace(/^#/, '');
    //
    // // Convert to RGB
    // let r = parseInt(hex.substring(0, 2), 16);
    // let g = parseInt(hex.substring(2, 4), 16);
    // let b = parseInt(hex.substring(4, 6), 16);
    //
    // // Calculate luminance
    // let luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
    //
    // // Return black or white depending on luminance
    // return luminance > 0.5 ? "#000000" : "#FFFFFF";


    hex = hex.replace(/^#/, '');

    let r = (255 - parseInt(hex.substring(0, 2), 16)).toString(16).padStart(2, '0');
    let g = (255 - parseInt(hex.substring(2, 4), 16)).toString(16).padStart(2, '0');
    let b = (255 - parseInt(hex.substring(4, 6), 16)).toString(16).padStart(2, '0');

    return `#${r}${g}${b}`;
}
