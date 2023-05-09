import Alpine from "alpinejs";
import { share } from "./shareable-url/shareable-url";

window.Alpine = Alpine;

window.Initializer = { share };

Alpine.start();

function* iterateComponentsTags(rootElem) {
    var iterator = document.createNodeIterator(
        rootElem,
        NodeFilter.SHOW_COMMENT,
        () => NodeFilter.FILTER_ACCEPT
    );

    let curNode;
    let startedNode = null;
    while ((curNode = iterator.nextNode())) {
        const content = curNode.nodeValue.trim();
        if (!content.startsWith("BLADE_COMPONENT_")) {
            continue;
        }

        let { type, data } = getNode(content);

        if (type === "START") {
            startedNode = { type, id: data, parent: curNode.parentNode };
            continue;
        }

        if (type === "DATA") {
            if (!startedNode) {
                throw new Error("No current node!");
            }
            startedNode.data = JSON.parse(data);
            if (startedNode.data.label.startsWith("components.")) {
                startedNode.data.label = startedNode.data.label.replace(
                    "components.",
                    ""
                );
            }
            startedNode.data.label = `<x-${startedNode.data.label}>`;
            startedNode.element = nextHtmlTagSibling(curNode);

            yield startedNode;

            continue;
        }

        if (type === "END") {
            startedNode = null;

            yield { type, id: data };
        }
    }

    return;
}

function nextHtmlTagSibling(node) {
    let next = node.nextSibling;

    while (next && ["#comment", "#text"].includes(next.nodeName)) {
        next = next.nextSibling;
    }

    return next;
}

function getNode(content) {
    const withoutPrefix = content.replace("BLADE_COMPONENT_", "");
    const dataStart = withoutPrefix.indexOf("[") + 1;
    const dataEnd = withoutPrefix.lastIndexOf("]");
    let data = withoutPrefix.slice(dataStart, dataEnd);
    const type = withoutPrefix.substr(0, dataStart - 1);

    return { type, data };
}

function getAllComments(rootElem) {
    var tree = {
        element: rootElem,
        parent: null,
        children: [],
    };
    let current = tree;

    for (let componentTag of iterateComponentsTags(rootElem)) {
        if (componentTag.type === "START") {
            const component = {
                label: componentTag.data.label,
                element: componentTag.element,
                // id: componentTag.id,
                // data: componentTag.data,
                children: [],
                parent: current,
            };
            current.children.push(component);
            current = component;
        }

        if (componentTag.type === "END") {
            current = current.parent;
        }
    }

    console.log(tree);
}

window.addEventListener("load", function () {
    console.log(getAllComments(document.documentElement));
});
