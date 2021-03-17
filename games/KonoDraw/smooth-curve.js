(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, global.SmoothCurve = factory());
  }(this, function () { 'use strict';
  
    const defaultOption = {
        closed: false,
        tension: 0.5
    };
    const distanceByPoints = (p1, p2) => {
        return Math.floor(Math.sqrt(Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2)));
    };
    const vector = (p1, p2) => {
        return [p2.x - p1.x, p2.y - p1.y];
    };
    const getTensionControlPoints = (p1, p2, p3, t = 0.5) => {
        const { x: x2, y: y2 } = p2;
        const v = vector(p1, p3);
        const d01 = distanceByPoints(p1, p2);
        const d12 = distanceByPoints(p2, p3);
        const d012 = d01 + d12;
        return [{ x: x2 - (v[0] * t * d01) / d012, y: y2 - (v[1] * t * d01) / d012 }, { x: x2 + (v[0] * t * d12) / d012, y: y2 + (v[1] * t * d12) / d012 }];
    };
    const getCurveControlPoints = (pathPoints, option) => {
        const CurveTension = option.tension || 0.5;
        const isClosed = option.closed || false;
        const pathControlPoints = [];
        let tension;
        const len = pathPoints.length;
        for (let i = 0; i < len - 2; i += 1) {
            tension = pathPoints[i + 1].curve ? CurveTension : 0;
            const [ctrl1, ctrl2] = getTensionControlPoints(pathPoints[i], pathPoints[i + 1], pathPoints[i + 2], tension);
            pathControlPoints.push(ctrl1, ctrl2);
        }
        // when curve is closed path
        if (isClosed) {
            tension = pathPoints[len - 1].curve ? CurveTension : 0;
            const [ctrl1, ctrl2] = getTensionControlPoints(pathPoints[len - 2], pathPoints[len - 1], pathPoints[0], tension);
            pathControlPoints.push(ctrl1, ctrl2);
            tension = pathPoints[0].curve ? CurveTension : 0;
            const [ctrl11, ctrl22] = getTensionControlPoints(pathPoints[len - 1], pathPoints[0], pathPoints[1], tension);
            pathControlPoints.push(ctrl11, ctrl22);
        }
        return pathControlPoints;
    };
    const drawCurvePath = (ctx, points, ctrlPoints, isClosed) => {
        const curvePath = new Path2D();
        ctx.beginPath();
        const len = points.length; // number of points
        if (len < 2)
            return undefined;
        if (len == 2) {
            curvePath.moveTo(points[0].x, points[0].y);
            curvePath.lineTo(points[1].x, points[1].y);
        }
        else {
            if (isClosed) {
                curvePath.moveTo(points[0].x, points[0].y);
                // from point 0 to point 1 is a quadratic curve
                curvePath.bezierCurveTo(ctrlPoints[2 * len - 1].x, ctrlPoints[2 * len - 1].y, ctrlPoints[0].x, ctrlPoints[0].y, points[1].x, points[1].y);
                // for all other points, connect them with cubic curves
                for (let i = 2; i < len; i += 1) {
                    curvePath.bezierCurveTo(ctrlPoints[2 * (i - 1) - 1].x, ctrlPoints[2 * (i - 1) - 1].y, ctrlPoints[2 * (i - 1)].x, ctrlPoints[2 * (i - 1)].y, points[i].x, points[i].y);
                }
                // from end to start, make curve closed
                curvePath.bezierCurveTo(ctrlPoints[2 * (len - 1) - 1].x, ctrlPoints[2 * (len - 1) - 1].y, ctrlPoints[2 * (len - 1)].x, ctrlPoints[2 * (len - 1)].y, points[0].x, points[0].y);
            }
            else {
                curvePath.moveTo(points[0].x, points[0].y);
                // from point 0 to point 1 is a quadratic curve
                curvePath.quadraticCurveTo(ctrlPoints[0].x, ctrlPoints[0].y, points[1].x, points[1].y);
                // for all middle points, connect then with cubic curves
                for (let i = 2; i < len - 1; i += 1) {
                    curvePath.bezierCurveTo(ctrlPoints[2 * (i - 1) - 1].x, ctrlPoints[2 * (i - 1) - 1].y, ctrlPoints[2 * (i - 1)].x, ctrlPoints[2 * (i - 1)].y, points[i].x, points[i].y);
                }
                // between last 2 points is also a quadratic curve
                curvePath.quadraticCurveTo(ctrlPoints[2 * (len - 2) - 1].x, ctrlPoints[2 * (len - 2) - 1].y, points[len - 1].x, points[len - 1].y);
            }
        }
        ctx.stroke(curvePath);
        ctx.closePath();
        return curvePath;
    };
    const draw = (pathCtx, pathPoints, option = {}) => {
        const options = Object.assign(defaultOption, option);
        let pathControlPoints = getCurveControlPoints(pathPoints, options);
        let curvePath = drawCurvePath(pathCtx, pathPoints, pathControlPoints, options.closed || false);
        return curvePath;
    };
    var index = {
        draw,
        getCurveControlPoints
    };
  
    return index;
  
  }));